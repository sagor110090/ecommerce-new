<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;

class NavbarController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }
    public function profileStore(Request $request)
    {
        $data = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            "email" => $request->email,
            "phone" => $request->phone,
            "facebook_userName" => $request->facebook_userName,
            "facebook_link" => $request->facebook_link,
            "twitter_userName" => $request->twitter_userName,
            "twitter_link" => $request->twitter_link,
            "bio" => $request->bio,
            "birthday" => $request->birthday,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->storeAS('uploads', rand() . '-' . $request->file('image')->getClientOriginalName());
            $setImage = 'storage/' . $data['image'];
            $img = Image::make($setImage)->resize(500, 500)->save($setImage);
            Storage::delete(Auth::user()->image);
        }

        // dd($data);
        $user = DB::table('users')->where('id', Auth::user()->id)->update($data);
        Helper::activityStore('App\Profile', 'profile update');
        return redirect('/admin/profile');
    }
    public function layoutStting($layout, $sidebar, $minisidebar)
    {
        if ($minisidebar != 0) {
            $isMiniSidebar = DB::table('minisidebars_setting')->where('user_id', Auth::user()->id)->first();
            if ($isMiniSidebar == false) {
                DB::table('minisidebars_setting')->insert([
                    'user_id' => Auth::user()->id,
                    'minisidebar' => 'sidebar-mini',
                ]);

            } else {
                DB::table('minisidebars_setting')->where('user_id', Auth::user()->id)->delete();
            }

        } else {

            if ($layout == 0) {
                $isSidebar = DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->first();

                if ($isSidebar != null) {
                    if ($sidebar != 1) {
                        DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->update([
                            'sidebar' => 'light theme-white dark-sidebar',
                        ]);
                    } else {
                        DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->update([
                            'sidebar' => 'dark theme-white theme-black',
                        ]);
                    }
                } else {
                    if ($sidebar != 1) {
                        DB::table('sidebars_setting')->insert([
                            'user_id' => Auth::user()->id,
                            'sidebar' => 'light theme-white dark-sidebar',
                        ]);

                    } else {
                        DB::table('sidebars_setting')->insert([
                            'user_id' => Auth::user()->id,
                            'sidebar' => 'dark theme-white theme-black',
                        ]);
                    }
                }

            } else {

                $isLayout = DB::table('layouts_setting')->where('user_id', Auth::user()->id)->first();

                if ($isLayout != null) {
                    if ($layout == 1) {
                        DB::table('layouts_setting')->where('user_id', Auth::user()->id)->update([
                            'layout' => 'light light-sidebar theme-white',
                        ]);
                        DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->delete();

                    } else {
                        DB::table('layouts_setting')->where('user_id', Auth::user()->id)->update([
                            'layout' => 'dark dark-sidebar theme-black',
                        ]);
                        DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->delete();

                    }
                } else {
                    if ($layout == 1) {
                        DB::table('layouts_setting')->insert([
                            'user_id' => Auth::user()->id,
                            'layout' => 'light light-sidebar theme-white',
                        ]);
                        DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->delete();

                    } else {
                        DB::table('layouts_setting')->insert([
                            'user_id' => Auth::user()->id,
                            'layout' => 'dark dark-sidebar theme-black',
                        ]);
                        DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->delete();

                    }
                }

            }
        }
        $mini = DB::table('minisidebars_setting')->where('user_id', Auth::user()->id)->first();
        if ($mini) {
            // return $mini->minisidebar;
            return response()->json($mini->minisidebar);
        }

        return 'ok';
    }

    public function restore()
    {
        DB::table('layouts_setting')->where('user_id', Auth::user()->id)->delete();
        DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->delete();
        DB::table('minisidebars_setting')->where('user_id', Auth::user()->id)->delete();

    }

}
