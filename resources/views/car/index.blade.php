@extends('layouts.app')

@section('footercontent')

            <div class="splash">
				<div class="spl-logo"></div>
    			<h1>Pick your perference - our new site or the one you’re used to.</h1>
    			<h2>You’ll get the same great rates at either.</h2>
    			<div class="spl-central">
    				<a href="{{ route('web.rentcar.index') }}" class="spl-left">
       					<div class="spl-left-pic"><img src="img/sp-new-site.jpg"  alt=""/></div>
            			<h3>GoGoFlorida.com</h3>
						<p>Our new feature rich website with the same great rates you love! <br /><span>Click here</span> to test drive the new site.</p>
					</a>
        			<a  href="https://www.gogoflorida.us/" class="spl-right">
        				<div class="spl-right-pic"><img src="img/sp-old-site.jpg"  alt=""/></div>
            			<h3>GoGoFlorida.us</h3>
            			<p>Our legacy website. <br /><br /><span>Click here</span></p>
        			</a>
				</div>
				<div class="clear"></div>
    			<div class="spl-dont-show">
    				<input type="checkbox" onclick="dontshowspalsh(this)" class="spl-checkbox" id="spl-checkbox1" />
					<label for="spl-checkbox1"><span>Don’t show me this message again.</span> <span class="spl-span2">I know where I want to go!</span></label>
    			</div>
			</div>
            <div class="splash-shadow"></div>

<div class="clear"></div>
<!-- /RENTAL COMPANY page -->

@endsection
