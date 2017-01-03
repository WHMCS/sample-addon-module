<h2>Secret Client Area Sample Page</h2>

<p>This is an example of a client area page that requires authentication to access.</p>

<p>You will have either been prompted to login or already have an active login state to access this page.</p>

<p>All the template variables you define along with some <a href="https://developers.whmcs.com/themes/variables/" target="_blank">additional standard template variables</a> are available within this template.<br>You can use the Smarty <em>{ldelim}debug{rdelim}</em> function call to see a full list.</p>

<hr>

<div class="row">
    <div class="col-sm-3">
        Module Link
    </div>
    <div class="col-sm-7">
        {$modulelink}
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        Config Text Field Value
    </div>
    <div class="col-sm-7">
        {$configTextField}
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        Custom Variable
    </div>
    <div class="col-sm-7">
        {$customVariable}
    </div>
</div>

<hr>

<p>
    <a href="{$modulelink}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i>
        Return to addon module default page
    </a>
</p>
