<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

// use Illuminate\Support\Facades\Input;

class EmailController extends Controller
{

    public function send()
    {
        return view('emails.index');
    }
    public function mailbox()
    {
        $emails = DB::table('mailboxs')->where('status', 'send')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('emails.mailbox', compact('emails'));
    }
    public function draftbox()
    {
        $emails = DB::table('mailboxs')->where('status', 'draft')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('emails.draft.draftbox', compact('emails'));
    }
    public function draft($id)
    {
        $email = DB::table('mailboxs')->find($id);
        return view('emails.draft.index', compact('email'));
    }
    public function showEdit($id)
    {
        $email = DB::table('mailboxs')->find($id);
        $user = Helper::findById('users', $email->user_id);
        // dd($user);
        return view('emails.single', compact('email', 'user'));
    }
    public function sendGroupMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'content' => 'required',
            // 'cc' => 'required',
            // 'bcc' => 'required',
        ]);
        $email = $request->email;
        $content = $request->content;
        $cc = $request->cc;
        $bcc = $request->bcc;

        // DB::table('emails')->insert([
        //     'email'=>$email,
        //     'content'=>$content,
        //     'cc'=>$cc,
        //     'bcc'=>$bcc,
        //     'created_at' => date("Y-m-d H:i:s"),
        // ]);
        foreach ($email as $key => $value) {
            Mail::to($email)
                ->cc($cc)
                ->bcc($bcc)
                ->queue(new EmailSend($content));
        }
        Session::flash('success', 'Successfully Send!');
        return redirect()->back();
    }
    public function sendSingleMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            // 'content' => 'required',
            // 'cc' => 'required',
            // 'bcc' => 'required',
        ]);
        $attachPath = '';
        $user = Auth::user();

        if ($request->hasFile('attach')) {
            $attachPath = $request->attach->storeAs('attachs', $user->fname . ' ' . $user->lname . '-' . Str::random(4) . '-' . $request->file('attach')->getClientOriginalName());
        }
        $email = $request->email;
        $subject = $request->subject;
        $content = $request->content;
        $attach = $attachPath;
        if ($request->status != 'send') {
            DB::table('mailboxs')->insert([
                'to' => $email,
                'from' => $user->email,
                'content' => $content,
                'subject' => $subject,
                'attach' => $attach,
                'status' => 'draft',
                'user_id' => $user->id,
                // 'created_at' => date("Y-m-d H:i:s"),
            ]);

            return response()->json('Draft Saved Successfully');
        } else {

            $data = ['content' => $content];

            $emailSendStatus = Mail::send('maileclipse::templates.new', $data, function ($message) use ($attach, $subject, $email, $request, $user) {
                $message->from($user->email, $user->fname . ' ' . $user->lname);
                $message->sender($user->email, $user->fname . ' ' . $user->lname);
                $message->to($email);
                $message->subject($subject);
                $message->priority(3);
                if ($request->hasFile('attach')) {
                    $message->attach(public_path('storage/' . $attach));
                }
            });
            // check for failures
            if (!Mail::failures()) {
                DB::table('mailboxs')->insert([
                    'to' => $email,
                    'from' => $user->email,
                    'content' => $content,
                    'subject' => $subject,
                    'attach' => $attach,
                    'status' => 'send',
                    'user_id' => $user->id,
                    // 'created_at' => date("Y-m-d H:i:s"),
                ]);
            }

            return response()->json('Email Send Successfully');

        }
    }

    public function destroyEmail(Request $request)
    {
        $deleteEmail = $request->get('select_email');
        if ($deleteEmail == null) {
            Session::flash('warning', 'Select The Check Box!');
        } else {
            foreach ($deleteEmail as $key => $value) {
                DB::table('mailboxs')->delete($value);
            }
            Session::flash('success', 'Successfully Deleted!');
        }
        return redirect('/admin/emails/mailbox');
    }

}
