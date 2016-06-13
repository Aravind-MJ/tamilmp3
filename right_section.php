<div class="col-md-4 col-sm-4 col-xs-12">
        <div class="home_sidebar">
            <div class="follow_us_side">
                <div class="ftm-title">
                    <h2>TOP COLLECTIONS</h2>
                </div>


                <div class="purchase_sidebar_img m_t_l" ng-repeat="name in listtc">
                    <img ng-src="images/TC {{ name }}.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>{{ name }}</p>
                        <div class="purchase_s">
                            <a href="List/{{ name }}">VIEW MORE</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="home_sidebar">
            <div class="follow_us_side">
                <div class="ftm-title">
                    <h2>POPULAR DOWNLOADS</h2>
                </div>

                <div class="purchase_sidebar_img m_t_l" ng-repeat="name in listpd | orderObjectBy:'count':true">
                    <img ng-src="{{ name.path }}/poster.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>{{ name.name }}</p>
                        <div class="purchase_s">
                            <a href="{{ name.loc }}">VIEW MORE</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>