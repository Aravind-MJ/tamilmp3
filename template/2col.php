<div class="row">
<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="m-t-f-p m-b-f-p-l">

        <ul class="top-filter-select">

            <li> <a href="#/NewReleases" class="active" data-pid="106" data-lang="tamil" data-toggle="tooltip" title="" data-original-title="Latest Releases"> New Releases </a> </li>

        </ul>

    </div>
    <div class = "col-md-6 col-sm-6 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat = "name in list1 track by $index">
                <div class = "lineup-artist">
                    <a href = "#/Album/A-ZMovieSongs/{{name.name}}"> {{ name.name}}
                    </a>
                    <small>[{{ name.year}}]</small>
                </div>
            </li>
        </ul>
    </div>
    <div class = "col-md-6 col-sm-6 col-xs-12">
        <ul class = "lineup">
            <li ng-repeat = "name in list2 track by $index">
                <div class = "lineup-artist">
                    <a href = "#/Album/A-ZMovieSongs/{{name.name}}"> {{ name.name}}
                    </a>
                    <small>[{{ name.year}}]</small>
                </div>
            </li>
        </ul>
    </div>
</div>

    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="home_sidebar">
            <div class="follow_us_side">
                <div class="ftm-title">
                    <h2>TOP COLLECTIONS</h2>
                </div>


                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/coll-img-1.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>LOVE SONGS 2016</p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
                        </div>
                    </div>
                </div>

                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/coll-img-2.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>SPB HITS</p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
                        </div>
                    </div>
                </div>

                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/coll-img3.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>AR RAHMAN HITS</p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
                        </div>
                    </div>
                </div>

                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/coll-img4.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>ILAYARAJA HITS</p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
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


                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/pop-img1.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>jithan-2</p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
                        </div>
                    </div>
                </div>

                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/pop-img2.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>Megaman </p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
                        </div>
                    </div>
                </div>

                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/pop-img3.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>Senthatti Kaalai Sevatha Kaalai</p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
                        </div>
                    </div>
                </div>

                <div class="purchase_sidebar_img m_t_l">
                    <img src="images/pop-img4.jpg" alt="Friends Tamil Mp3">
                    <div class="purchase_overlay"></div>
                    <div class="purchase_sidebar_text">
                        <p>Irudhi Sutru</p>
                        <div class="purchase_s">
                            <a href="#">VIEW MORE</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>