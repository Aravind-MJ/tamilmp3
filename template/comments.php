<?php

?>
<div class="comment">
    <h2>Comment</h2>

    <p>In order to improve our performance we expect your comments, suggestions and feed back. You can also be the part
        of us in improving this site by sending valuable suggestions and requesting missing albums or songs.</p>
</div>
<div class="contact" id="contact">
    <div class="contact-grids">
        <div class="alert alert-success success-message" style="display: none">
            Your comment Submitted Successfully!
        </div>

        <div class="alert alert-danger failed-message" style="display: none">
            Failed to submit your Comment!
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 contact-form">
            <form ng-submit="submit()">
                <input type="text" name="First Name" placeholder="Your Name" required="" ng-model="fields.name">
                <input class="email" name="Location" type="text" placeholder="Location" required=""
                       ng-model="fields.location">
                <input type="text" name="Number" placeholder="Mobile Number" required="" ng-model="fields.number"
                       pattern="[0-9]{10}" maxlength="10">
                <input class="email" name="Email" type="email" placeholder="Email" required="" ng-model="fields.email">
                <textarea name="Comment" placeholder="Comment" required="" ng-model="fields.comment"></textarea>

                <div
                    vc-recaptcha
                    theme="'light'"
                    key="model.key"
                    on-create="setWidgetId(widgetId)"
                    on-success="setResponse(response)"
                    on-expire="cbExpiration()"
                    ></div>
                <input type="submit" value="SUBMIT">
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>