<footer class="section section-primary" >
	<div class="container container-fluid">
		<div class="pull-left">
			<ul class="list-inline" style="padding-top:1em;">
				<li>
					<a href="{{env('APP_URL')}}/release">Release Information</a>
				</li>
				<li>
					<a href="{{env('APP_URL')}}/docs">Documentation</a>
				</li>
				<li>
					Logged in as @{{ currentUserId }}
				</li>
				<li>
					<a href="/apps/authentication/pb_logout.php?app={{urlencode(env('PB_APP_NAME'))}}&returnURL={{urlencode(env('APP_URL'))}}">Logout</a>
				</li>
			</ul>
		</div>
		<div class="pull-right">
			<a href="http://www.pointblue.org/our-science-and-services/conservation-tools/data-solutions/">Powered by Point Blue Data Solutions</a>
			<a href="http://www.pointblue.org"><img src="//data.pointblue.org/apps/assets/images/pb-logo-full.png" height="60px"></a>
		</div>
	</div>
</footer>
{{-- Create bottom spacing that gives the zendesk feedback widget a place to settle --}}
<div style="margin-top: 3em;">&nbsp;</div>