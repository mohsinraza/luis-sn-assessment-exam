<?php
    wp_enqueue_script('simplenursing-vue-node-tree', get_stylesheet_directory_uri() . '/js/component-school-permissions-video-node-tree.vue.js', ['vue-js'], rand(), true);
    wp_enqueue_script('simplenursing-vue-tree', get_stylesheet_directory_uri() . '/js/component-school-permissions-video-tree.vue.js', ['vue-js'], rand(), true);
    wp_enqueue_script('simplenursing-vue-school-student-groups', get_stylesheet_directory_uri() . '/js/simplenursing-vue-school-student-groups.js', ['simplenursing'], rand(), true);
?>

<div id="app-student-groups">
    <main class="main--internal--schools">
      <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Student Groups</h1>
            </div>
        </div>




        <div class="row">
            <!-- cards_cta__item -->
            <div class="col-12">
                <div class="mt-1">
                    <b-button-group>
                        <b-button class="btn-primary" size="sm" @click="createNewGroupOpenModal">Create New Group</b-button>
                        <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="deleteGroupOpenModal">Delete Group</b-button>
                        <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="renameGroupOpenModal">Rename Group</b-button>
                    </b-button-group>
                </div>

                <b-table
                    hover
                    class="table-schools table-groups"
                    :items="items"
                    :fields="fields"
                    :sort-by.sync="groupSortBy"
                    :sort-desc.sync="groupSortDesc"
                    responsive="sm"
                    :select-mode="selectMode"
                    responsive="sm"
                    ref="groupTable"
                    selectable
                    @row-selected="groupTableRowSelected"
                    >
                    <template #cell(selectedGroup)="{ rowSelected }">
                        <template v-if="rowSelected">
                          <span aria-hidden="true">&check;</span>
                          <span class="sr-only">Selected</span>
                        </template>
                        <template v-else>
                          <span aria-hidden="true">&nbsp;</span>
                          <span class="sr-only">Not selected</span>
                        </template>
                    </template>
                </b-table>

                <div class="row">
                    <div class="col-12">
                        <div class="mt-3">
                            <b-button-group>
                                <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="editGroupPermissionsOpenModal">Video Permissions</b-button>
                                <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="editStudyGuidesPermissionsOpenModal">Study Guides Permissions</b-button>
                                <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="editQuizBanksPermissionsOpenModal">Quiz Banks Permissions</b-button>
                                <b-button v-if="currentUser.is_school_admin" class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="toggleNclexAccess">Toggle NCLEX Access</b-button>

                                <!-- <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="addSyllabusOpenModal">Add Syllabus (BETA)</b-button> -->
                                <!-- <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="removeSyllabusOpenModal">Remove Syllabus (BETA)</b-button> -->
                            </b-button-group>
                        </div>
                    </div>
                </div>

                <div v-if="selectedGroup.group_id" class="group-details mt-3">
                    <b-card
                      header="Group Details"
                      header-tag="header"
                    >
                    <b-card-text>
                        Send the URL to students to invite them to this group, or give them this code: <strong>{{groupInviteCode}}</strong>
                    </b-card-text>
                      <b-card-text>
                          <strong>Registration URL:</strong>
                          <b-link :href="registrationUrl">{{registrationUrl}}</b-link>
                      </b-card-text>
                    </b-card>
                </div>

                <div class="mt-3">
                    <b-table
                        hover
                        class="table-schools table-students"
                        :items="studentsList"
                        :fields="studentFields"
                        :sort-by.sync="studentSortBy"
                        :sort-desc.sync="studentSortDesc"
                        responsive="sm"
                        :select-mode="selectMode"
                        responsive="sm"
                        ref="studentsTable"
                        selectable
                        >
                        <template #cell(selectedStudent)="{ rowSelected }">
                            <template v-if="rowSelected">
                              <span aria-hidden="true">&check;</span>
                              <span class="sr-only">Selected</span>
                            </template>
                            <template v-else>
                              <span aria-hidden="true">&nbsp;</span>
                              <span class="sr-only">Not selected</span>
                            </template>
                        </template>
                    </b-table>
                </div>
            </div>

        </div>
      </div>

    </main>

    <?php get_template_part('template-parts/school-management/student-groups/modal-groups-create'); ?>
    <?php get_template_part('template-parts/school-management/student-groups/modal-groups-delete'); ?>
    <?php get_template_part('template-parts/school-management/student-groups/modal-groups-rename'); ?>
    <?php get_template_part('template-parts/school-management/student-groups/modal-groups-permissions'); ?>
    <?php get_template_part('template-parts/school-management/student-groups/modal-groups-permissions-study-guides'); ?>
    <?php get_template_part('template-parts/school-management/student-groups/modal-groups-permissions-quiz-banks'); ?>
    <?php get_template_part('template-parts/school-management/student-groups/modal-groups-syllabus'); ?>

</div>
