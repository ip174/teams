<ul class="nav nav-tabs inboxmenu">
	<li class="{{ isset($fetch_type) && $fetch_type=='all' ? 'active' : '' }}">
		<a href="{{ url('/chat/job-chat-box/'.$job_id) }}/all">
			All
		</a>
	</li>
	<li class="{{ isset($fetch_type) && $fetch_type=='inbox' ? 'active' : '' }}">
		<a href="{{ url('/chat/job-chat-mailbox/'.$job_id) }}/inbox">
			Inbox<!--<span class="badge">3</span>-->
		</a>
	</li>
	<li class="{{ isset($fetch_type) && $fetch_type=='starred' ? 'active' : '' }}">
		<a href="{{ url('/chat/job-chat-mailbox/'.$job_id) }}/starred">
			Starred
		</a>
	</li>
	<li class="{{ isset($fetch_type) && $fetch_type=='sent' ? 'active' : '' }}">
		<a href="{{ url('/chat/job-chat-mailbox/'.$job_id) }}/sent">
			Sent
		</a>
	</li>
	<!--<li class="{{ isset($fetch_type) && $fetch_type=='archived' ? 'active' : '' }}">
		<a href="javascript:void(0);">
			Archived
		</a>
	</li>-->
</ul>

<!--<a href="javascript:void(0);" class="allpropsallink">All Proposals Received</a>-->