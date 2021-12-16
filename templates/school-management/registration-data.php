<?php


global $sn_current_user;

if ($sn_current_user->is_school_manager()) {
    //var_dump($sn_current_user->get_manager_id());

    $school_manager = new SN_School_Manager($sn_current_user->get_manager_id());
    // var_dump($school_manager);
    $school = new SN_School($school_manager->school_id);
    // var_dump($school);
}

?>
<main class="main--internal">
  <div class="container">
    <div class="row">

        <!-- cards_cta__item -->
        <div class="col-12">
            <strong>School Name:</strong> <?php echo $school->get_school_name() ?>
            <br />
            <strong>Contract End Date:</strong> <?php echo $school->end_date ?>
            <br />
            <strong>Premium:</strong> <?php echo ($school->has_membership()?'Yes':'No') ?>
            <br />
            <strong>NCLEX:</strong> <?php echo ($school->has_nclex()?'Yes':'No') ?>
            <br />
            <strong>Total Students:</strong> <?php echo $school->get_students_count() ?>
        </div>

    </div>
  </div>

</main>
