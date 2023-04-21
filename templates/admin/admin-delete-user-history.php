<?php
global $sn_current_user;
// Only authors or allowed users
if (!$sn_current_user->is_sn_admin()) {
    echo 'No Access Permissions';
    return;
}
$error_message=false;
$has_action = isset($_GET["action"]);
$return="";
if ($has_action) {
    $action = $_GET["action"];
    $submitted=true;
} else {
    $submitted=false;
}

if ($submitted==true)  {
    if ($action=="search_member") {
        $assessment_exams = sn_get_member_assessment_exam();
        var_dump($assessment_exams);
    }

    if ($action=="delete_aex") {
        $return = sn_delete_member_assessment_exam();
    }
}

if ($return!==TRUE) {
    $error_message = $return;

}


?>
<?php get_template_part('template-parts/header/menu', 'mobile'); ?>

<div class="body_content">

      <?php get_template_part('template-parts/sidebar/left-sidebar'); ?>

      <!-- body_content__wrapper -->
      <div class="body_content__wrapper">
        <div class="text-center">

          <!-- hero_dashboard -->
          <div class="hero_dashboard hero_dashboard--internal hero_dashboard--no_picture">

            <?php get_template_part('template-parts/header/menu','links'); ?>

            <?php get_template_part('template-parts/header/search','form'); ?>

            <div class="clearfix"></div>

            <div class="warning_ghost"></div>



            <h1 tabindex="0">
              SimpleNursing Administration
            </h1>

          </div>
          <!-- /hero_dashboard -->

<div class="container search-question">
    <div class="row">
        <div class="col">
            <h3>Remove Study Plan</h3>
            <p>
                Remove the Study Plan Assignments and Study Plan
            </p>

            <form id="myForm" method="get">
              <label for="email">Member Email:</label>
              <input type="hidden" id="action" name="action" value="search_member">
              <input type="email" id="email" name="email" value="<?=isset($_GET["email"])?$_GET["email"]:''?>" style="width:400px;">
              <input type="submit" value="Search Member">
            </form>
            <?php if ($return===TRUE): ?>
                <div class="alert alert-success" role="alert">
                  Assessment Exams Removed
                </div>
            <?php elseif($return===FALSE): ?>
                <div class="alert alert-danger" role="alert">
                  <?= $error_message ?>
                </div>
            <?php //endif ?>

            <?php elseif ($assessment_exams === "Assessment exams not found"): ?>
                <div class="alert alert-success" role="alert">
                  No exam data found with this email
                </div>
            <?php elseif (count($assessment_exams)!=0): ?>
                <div class="alert alert-danger" role="alert">
                  <?= 'Total '.count($assessment_exams) .' assessment exam(a) found.' ?>
                </div>
            <?php endif ?>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <?php if ($assessment_exams !== "Assessment exams not found"): ?>
                <h2 class="search-post-type">Assesment Exams</h2>
                <div>
                    <?php if (count($assessment_exams)!=0): ?>
                        <?=$assessment_exams[0]->user_id?>
                        <form id="myForm" method="get" onsubmit="return confirm('Do you really want to delete the assessment exams data of this member?');">
                        <input type="hidden" id="action" name="action" value="delete_aex">
                        <input type="hidden" id="action" name="user_id" value="<?=$assessment_exams[0]->user_id?>">
                        <label for="delete_checkbox">Do you want to delete this member's all assesment exams data?</label>
                        <input type="checkbox" name="delete_checkbox" id="delete_checkbox">
                        <input type="submit" value="Delete" id="delete_button" disabled>
                    <?php endif ?>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Exam Id</td>
                            <td>Date</td>
                            <td>Ability Estimate</td>
                            <td>Passed</td>
                            <td>Completed</td>
                        </tr>
                    </thead>
                    <tbody>
                
                    <?php foreach ($assessment_exams as $key => $exam): ?>
                        <tr>
                            <td><?=$exam->exam_id?></td>
                            <td><?=$exam->date?></td>
                            <td><?=$exam->ability_estimate?></td>
                            <td><?=$exam->passed?></td>
                            <td><?=$exam->completed?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if ($search_quiz_banks): ?>
                <h2 class="search-post-type">QUIZ BANKS</h2>
                <?php foreach ($search_quiz_banks as $search): ?>
                    <h3><?php echo get_the_title($search->ID); ?></h3>
                    <a href="<?php echo get_the_permalink( $search->ID ) ?>">
                        <?php echo get_the_permalink( $search->ID ) ?>
                    </a>
                    <?php the_field('quiz_bank_question', $search->ID); ?>
                    <hr />
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if ($search_nclex): ?>
                <h2 class="search-post-type">NCLEX RN</h2>
                <?php foreach ($search_nclex as $search): ?>
                    <h3><?php echo get_the_title($search->ID); ?></h3>
                    <a href="<?php echo get_the_permalink( $search->ID ) ?>">
                        <?php echo get_the_permalink( $search->ID ) ?>
                    </a>
                    <?php the_field('nclex_question', $search->ID); ?>
                    <hr />
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if ($search_nclex): ?>
                <h2 class="search-post-type">NCLEX ADAPTIVE QUESTIONS</h2>
                <?php foreach ($search_nclex as $search): ?>
                    <h3><?php echo get_the_title($search->ID); ?></h3>
                    <a href="<?php echo get_the_permalink( $search->ID ) ?>">
                        <?php echo get_the_permalink( $search->ID ) ?>
                    </a>
                    <?php the_field('assessment_question', $search->ID); ?>
                    <hr />
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if ($search_nclex_pn): ?>
                <h2 class="search-post-type">NCLEX PN</h2>
                <?php foreach ($search_nclex_pn as $search): ?>
                    <h3><?php echo get_the_title($search->ID); ?></h3>
                    <a href="<?php echo get_the_permalink( $search->ID ) ?>">
                        <?php echo get_the_permalink( $search->ID ) ?>
                    </a>
                    <?php the_field('nclex_question', $search->ID); ?>
                    <hr />
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if ($search_assessment_question): ?>
                <h2 class="search-post-type">ADAPTIVE NCLEX</h2>
                <?php foreach ($search_assessment_question as $search): ?>
                    <h3><?php echo get_the_title($search->ID); ?></h3>
                    <a href="<?php echo get_the_permalink( $search->ID ) ?>">
                        <?php echo get_the_permalink( $search->ID ) ?>
                    </a>
                    <?php the_field('assessment_question', $search->ID); ?>
                    <hr />
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if ($search_teas): ?>
                <h2 class="search-post-type">TEAS</h2>
                <?php foreach ($search_teas as $search): ?>
                    <h3><?php echo get_the_title($search->ID); ?></h3>
                    <a href="<?php echo get_the_permalink( $search->ID ) ?>">
                        <?php echo get_the_permalink( $search->ID ) ?>
                    </a>
                    <?php the_field('question', $search->ID); ?>
                    <hr />
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if ($search_entrance): ?>
                <h2 class="search-post-type">ENTRANCE</h2>
                <?php foreach ($search_entrance as $search): ?>
                    <h3><?php echo get_the_title($search->ID); ?></h3>
                    <a href="<?php echo get_the_permalink( $search->ID ) ?>">
                        <?php echo get_the_permalink( $search->ID ) ?>
                    </a>
                    <?php the_field('question', $search->ID); ?>
                    <hr />
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>

</div>


    </div>

    <?php get_template_part('template-parts/footer/footer', 'main'); ?>
<style>
    .search-question {
        padding: 20px;
    }

    .search-question form {
        margin-bottom: 25px;
    }

    .search-question h3 {
        margin-bottom: 0;
    }

    .search-question a {
        margin-bottom: 20px;
        display: block;
    }

    .search-post-type {
        margin-bottom: 20px;
        background-color: #00709C;
        color: #fff;
        padding: 30px;
    }
</style>

<script>
    jQuery(document).ready(function ($) {
        $('#delete_checkbox').click(function (event) {
            if (this.checked) {
                console.log('isChecked:'+this.checked);
                $('#delete_button').removeAttr('disabled');
            } else {
                console.log('isChecked:'+this.checked);
                $("#delete_button").prop("disabled", true);
            }
        });
        // $("#delete_checkbox").prop("checked", true);
    });
</script>
<?php
// search member's assessment exams data by email 
function sn_get_member_assessment_exam() {
    if(isset($_GET["email"])){
      $email = $_GET["email"];
      //Get wordpress user id by email
      $user = get_user_by('email', $email);
      if($user){
        $user_id = $user->ID;
        global $wpdb;
        //Get all assessment exams list from the table sn_assessment_exam where user_id is the member user id
         $result = $wpdb->get_results("SELECT * FROM sn_assessment_exam WHERE user_id = $user_id");
         if($result){
           return $result;
       } else {
           return "Assessment exams not found";
       }
      } else {
        return "User not found";
      }
    }
}

// delete SP from a member
function sn_delete_member_assessment_exam() {
    if(isset($_GET["user_id"])){
            $user_id = $_GET["user_id"];
            global $wpdb;
            //Get all assessment exams list from the table sn_assessment_exam where user_id is the member user id
            $result = $wpdb->get_results("SELECT exam_id FROM sn_assessment_exam WHERE user_id = $user_id");
            foreach ($result as $key => $aex) {
                //Delete all records from table sn_assessment_exam_answers where user_id is the $user_id from the sn_study_plan
                $result1 = $wpdb->delete('sn_assessment_exam_answers', array('exam_id' => $aex->exame_id), array('%d'));
            }
            
           if($result !== false){
               //Delete all records from table sn_assessment_exam where user_id is equal to member_id
               $result2 = $wpdb->delete('sn_assessment_exam', array('user_id' => $user_id), array('%d'));
                if($result !== false){
                    return true;
                } else {
                    return "Error removing records from sn_assessment_exam";
                }
           } else {
             return "Error removing records sn_assessment_exam_answers";
           }
    }
}
