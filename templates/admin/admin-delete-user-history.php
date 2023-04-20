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
    if ($action=="delete_sp") {
        $return = sn_delete_sp();

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
              <input type="email" id="email" name="email">
              <input type="hidden" id="action" name="action" value="delete_sp">
              <input type="submit" value="Delete Study Plan">
            </form>
            <?php if ($return===TRUE): ?>
                <div class="alert alert-success" role="alert">
                  Study Plan Removed
                </div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert">
                  <?= $error_message ?>
                </div>
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


<?php
// delete SP from a member
function sn_delete_sp() {
    if(isset($_GET["email"])){
      $email = $_GET["email"];
      //Get wordpress user id by email
      $user = get_user_by('email', $email);
      if($user){
        $user_id = $user->ID;
        global $wpdb;
        //Get the ID from the table sn_study_plan where user_id is the WP User ID
         $result = $wpdb->get_row("SELECT ID FROM sn_study_plan WHERE user_id = $user_id", ARRAY_A);
         if($result){
           $sp_id = $result['ID'];
           //Delete all records from table sn_study_plan_assignments where sp_id is the ID from the sn_study_plan
           $result = $wpdb->delete('sn_study_plan_assignments', array('sp_id' => $sp_id), array('%d'));
           if($result !== false){
               //Delete all records from table sn_study_plan where ID
               $result2 = $wpdb->delete('sn_study_plan', array('ID' => $sp_id), array('%d'));
                if($result !== false){
                    return true;
                } else {
                    return "Error removing records from sn_study_plan";
                }
           } else {
             return "Error removing records sn_study_plan_assignments";
           }
       } else {
           return "Study Plan not found";
       }
      } else {
        return "User not found";
      }
    }
}
