<?php
    wp_enqueue_script('simplenursing-vue-school-students', get_stylesheet_directory_uri() . '/js/simplenursing-vue-school-students.js', ['simplenursing'], rand(), true);
?>
<div id="app-students">
    <main class="main--internal--schools">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <h1>Students</h1>
              </div>
          </div>
          <div class="row">
              <div class="col-12 col-lg-6">
                  <b-form-group
                      class="m-0 p-0"
                      v-slot="{ ariaDescribedby }"
                    >
                    <b-form-input
                          id="filter-input"
                          v-model="filterText"
                          type="search"
                          placeholder="Search by student name or email"
                        ></b-form-input>
                    </b-form-group>
              </div>
              <div class="col-12 col-lg-3">
                      <b-form-group
                          class="m-0 p-0"
                        >
                      <b-input-group size="sm">
                          <b-form-select
                            id="select-student-groups"
                            v-model="studentGroupSelected"
                            :options="studentGroups"
                            class="w-100"
                            style="height:38px"
                            @change="studentsGroupLoad"
                          >
                            <template #first>
                              <option value="0">Filter by Groups</option>
                            </template>
                          </b-form-select>
                        </b-input-group>
                    </b-form-group>
              </div>
              <div class="col-12 col-lg-3">
                    <b-button class="btn-squared" size="sm" @click="openAdvancedFilters">Advanced Filters</b-button>
              </div>

          </div>
          <div class="mt-2">
              <b-button class="btn-primary" size="sm" @click="selectAllRows">Select all</b-button>
              <b-button class="btn-primary" size="sm" @click="clearSelected">Clear selected</b-button>

          </div>
          <div class="mt-2">
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="openAddStudentsToGroupModal">Add to Group</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="openRemoveStudentsFromGroupModal">Remove from Group</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="activateStudents">Activate</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="deactivateStudents">Deactivate</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="csvExport">Export to CSV</b-button>
          </div>
        <div class="row mt-3">
            <!-- cards_cta__item -->
            <div class="col-12">
                <b-form-checkbox
                    id="checkbox-active"
                    name="checkbox-active"
                    v-model="filterOnlyActiveStudents"
                    value="Yes"
                    unchecked-value="No"
                    switch
                    class="d-inline-block"
                    >
                    Only Active Students
                </b-form-checkbox>
                <span class="float-right">Selected Students: {{selected.length}}</span>
                <b-overlay
                  :show="tableLoading"
                  rounded
                  opacity="0.6"
                  spinner-small
                  spinner-variant="primary"
                >
                    <b-table
                        hover
                        striped
                        outlined
                        head-variant="dark"
                        class="table-schools table-students"
                        :items="items"
                        :fields="fields"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :select-mode="selectMode"
                        responsive="md"
                        ref="studentsTable"
                        selectable
                        @row-selected="onRowSelected"
                        :filter="filter"
                        :filter-function="filterTable"
                        >
                        <template #cell(selected)="{ rowSelected }">
                            <template v-if="rowSelected">
                              <span aria-hidden="true">&check;</span>
                              <span class="sr-only">Selected</span>
                            </template>
                            <template v-else>
                              <span aria-hidden="true">&nbsp;</span>
                              <span class="sr-only">Not selected</span>
                            </template>
                        </template>

                        <template #cell(actions)="row">
                           <b-button variant="primary" size="sm" @click="getStudentDetails(row)">
                              {{ row.detailsShowing ? 'Hide' : 'Show' }}
                            </b-button>
                         </template>

                         <template #row-details="row">

                             <div>
                               <b-card no-body>
                                 <b-tabs pills card vertical >
                                   <b-tab title="Quiz Banks" active>
                                       <b-card-text>
                                           <b-card>
                                               <b-card-text>
                                                   <div class="performance_review">
                                                     <ul>
                                                       <li class="performance_review__item performance_review__item--number_tests">
                                                         <div>Quiz Banks</div>
                                                         <div v-if="!row.item.qb_loading" class="performance_review__item__value">
                                                             {{row.item.qb_total_quizzes}}
                                                         </div>
                                                         <b-spinner v-if="row.item.qb_loading" label="Spinning"></b-spinner>
                                                       </li>
                                                       <li class="performance_review__item performance_review__item--hit_rate">
                                                         <div>Score</div>
                                                         <div v-if="!row.item.qb_loading" class="performance_review__item__value">
                                                             {{row.item.qb_total_score}}<span>%</span>
                                                         </div>
                                                         <b-spinner v-if="row.item.qb_loading" label="Spinning"></b-spinner>
                                                       </li>
                                                     </ul>
                                                   </div>
                                             </b-card-text>
                                             <b-button v-if="row.item.qb_total_quizzes>0" class="btn-primary" size="sm" @click="studentInfoQuizBanks(row.item, row.index, $event.target)" class="mr-1">
                                               Quizzes Details
                                             </b-button>
                                           </b-card>
                                       </b-card-text>
                                   </b-tab>
                                   <b-tab title="NCLEX">
                                       <b-card-text>
                                           <b-card>
                                               <b-card-text>
                                                   <div class="performance_review">
                                                       <ul>
                                                           <li class="performance_review__item performance_review__item--number_tests">
                                                               <div>NCLEX</div>
                                                               <div v-if="!row.item.nclex_loading" class="performance_review__item__value">
                                                                   {{row.item.nclex_total_quizzes}}
                                                               </div>
                                                               <b-spinner v-if="row.item.nclex_loading" label="Spinning"></b-spinner>
                                                           </li>
                                                           <li class="performance_review__item performance_review__item--hit_rate">
                                                               <div>Score</div>
                                                               <div v-if="!row.item.nclex_loading" class="performance_review__item__value">
                                                                   {{row.item.nclex_total_score}}<span>%</span>
                                                               </div>
                                                               <b-spinner v-if="row.item.nclex_loading" label="Spinning"></b-spinner>
                                                           </li>
                                                       </ul>
                                                   </div>
                                               </b-card-text>
                                               <b-button v-if="row.item.nclex_total_quizzes>0" class="btn-primary" size="sm" @click="studentInfoNCLEX(row.item, row.index, $event.target)" class="mr-1">
                                                   NCLEX Details
                                               </b-button>
                                           </b-card>
                                       </b-card-text>
                                   </b-tab>
                                   <b-tab title="Video Library">
                                       <b-card-text>
                                           <div v-if="!row.item.videos_loading">
                                               <b-table
                                                    striped
                                                    outlined
                                                    hover
                                                    :fields="videosWatchedFields"
                                                    :items="row.item.videos_watched">
                                                </b-table>
                                           </div>
                                           <b-spinner v-if="row.item.videos_loading" label="Spinning"></b-spinner>
                                       </b-card-text>
                                   </b-tab>
                                   <b-tab title="Study Guides">
                                       <b-card-text>
                                           <div v-if="!row.item.study_guides_loading">
                                               <b-table
                                                    striped
                                                    outlined
                                                    hover
                                                    :fields="studyGuidesWatchedFields"
                                                    :items="row.item.study_guides_downloaded">
                                                </b-table>
                                           </div>
                                           <b-spinner v-if="row.item.study_guides_loading" label="Spinning"></b-spinner>
                                       </b-card-text>
                                   </b-tab>
                                 </b-tabs>
                               </b-card>
                             </div>

                        </template>
                    </b-table>

                </b-overlay>

            </div>

        </div>
      </div>

    </main>

    <b-modal :id="infoModal.id" :title="infoModal.title" ok-title="Close" ok-only @hide="resetInfoModal">
        <b-list-group>
            <b-list-group-item v-for="exam in infoModal.content">
                <strong>Date:</strong> {{exam.post_date.substring(0,10)}}<br />
                <strong>Total Questions:</strong> {{exam.performance.total_answers}}<br />
                <strong>Score:</strong> {{exam.performance.success_ratio*100}}%
            </b-list-group-item>
        </b-list-group>
    </b-modal>

    <?php get_template_part('template-parts/school-management/students/modal-school-groups'); ?>
    <?php get_template_part('template-parts/school-management/students/modal-advanced-filters'); ?>
    <?php get_template_part('template-parts/school-management/modals/modal-progress'); ?>


</div>
