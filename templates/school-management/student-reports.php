<div class="text-center">
    <!-- main -->
    <main class="main--internal--schools">
      <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Student Reports</h1>
            </div>
        </div>
        <div class="row">
            <!-- cards_cta__item -->
            <div class="col-12 col-lg-6 col-xl-4 mb-2">
                <?php
                    $card=array(
                        'title'=>'Quiz Banks Reports',
                        'href'=>'/school-management/report-quizzes',
                        'content'=>'Quizzes created and scores.',
                        'class'=>'fas fa-chart-bar',
                    );
                    set_query_var( 'card', $card );
                    get_template_part('template-parts/school-management/card','data');
                ?>
            </div>

            <!-- cards_cta__item -->
            <div class="col-12 col-lg-6 col-xl-4 mb-2">
                <?php
                    $card=array(
                        'title'=>'NCLEX Reports',
                        'href'=>'/school-management/report-nclex',
                        'content'=>'Exams created and scores.',
                        'class'=>'fas fa-chart-bar',
                    );
                    set_query_var( 'card', $card );
                    get_template_part('template-parts/school-management/card','data');
                ?>
            </div>

            <div class="col-12 col-lg-6 col-xl-4 mb-2">
                <?php
                    $card=array(
                        'title'=>'Video Library Reports',
                        'href'=>'/school-management/report-video-library',
                        'content'=>'Statistics from the video library.',
                        'class'=>'fas fa-video',
                    );
                    set_query_var( 'card', $card );
                    get_template_part('template-parts/school-management/card','data');
                ?>
            </div>

            <div class="col-12 col-lg-6 col-xl-4 mb-2">
                <?php
                    $card=array(
                        'title'=>'Study Guides Reports',
                        'href'=>'/school-management/report-study-guides',
                        'content'=>'Statistics for Study Guides.',
                        'class'=>'fas fa-book',
                    );
                    set_query_var( 'card', $card );
                    get_template_part('template-parts/school-management/card','data');
                ?>
                </div>
            </div>
        </div>
    </main>
    <!-- /main -->
</div>
