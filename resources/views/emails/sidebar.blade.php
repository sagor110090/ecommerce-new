<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <div class="card">
        <div class="body">
            <div id="mail-nav">
                <button type="button"
                    class="btn btn-danger waves-effect btn-compose m-b-15">COMPOSE</button>
                <ul class="" id="mail-folders">
                    <li class="{{ Request::is('admin/emails/mailbox') ? 'active':''}}">
                        <a href="{{ url('admin/emails/mailbox') }}" title="Sent">Sent
                            ({{Helper::getAll('mailboxs')->where('status','send')->where('user_id',Auth::user()->id)->count()}})</a>
                    </li>
                    <li class="{{ Request::is('admin/emails/draftbox') ? 'active':''}}">
                        <a href="{{ url('admin/emails/draftbox') }}"
                            title="Draft">Draft({{Helper::getAll('mailboxs')->where('status','draft')->where('user_id',Auth::user()->id)->count()}})</a>
                    </li>
                    <li>
                        <a href="javascript:;" title="Bin">Bin</a>
                    </li>
                    <li>
                        <a href="javascript:;" title="Important">Important</a>
                    </li>
                    <li>
                        <a href="javascript:;" title="Starred">Starred</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>