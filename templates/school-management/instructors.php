<?php
    wp_enqueue_script('simplenursing-vue-school-instructors', get_stylesheet_directory_uri() . '/js/simplenursing-vue-school-instructors.js', ['simplenursing'], rand(), true);
?>
<div id="app-instructors">
    <main class="main--internal--schools">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <h1>Instructors</h1>
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
                          placeholder="Search by instructor name or email"
                        ></b-form-input>
                    </b-form-group>
              </div>
              <div class="col-12 col-lg-6">
                      <b-form-group
                          class="m-0 p-0"
                        >
                      <b-input-group size="sm">
                          <b-form-select
                            id="select-instructor-groups"
                            v-model="instructorGroupSelected"
                            :options="instructorGroups"
                            class="w-100"
                            style="height:38px"
                            @change="InstructorsGroupLoad"
                          >
                            <template #first>
                              <option value="0">Filter by Groups</option>
                            </template>
                          </b-form-select>
                        </b-input-group>
                    </b-form-group>
              </div>

          </div>
          <div class="mt-2">
              <b-button class="btn-primary" size="sm" @click="selectAllRows">Select all</b-button>
              <b-button class="btn-primary" size="sm" @click="clearSelected">Clear selected</b-button>

          </div>
          <div class="mt-2">
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="openAddInstructorsToGroupModal">Add to Group</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="openRemoveInstructorsFromGroupModal">Remove from Group</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="activateInstructors">Activate</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="deactivateInstructors">Deactivate</b-button>
              <b-button class="btn-primary" :disabled="selected.length==0" size="sm" @click="csvExport">Export to CSV</b-button>
          </div>
        <div class="row mt-3">
            <!-- cards_cta__item -->
            <div class="col-12">
                <b-form-checkbox
                    id="checkbox-active"
                    name="checkbox-active"
                    v-model="filterOnlyActiveInstructors"
                    value="Yes"
                    unchecked-value="No"
                    switch
                    >
                    Only Active Instructors
                </b-form-checkbox>
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
                        ref="instructorsTable"
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
                    </b-table>
                    <span>Selected Instructors: {{selected.length}}</span>
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

    <?php get_template_part('template-parts/school-management/instructors/modal-school-groups'); ?>

</div>
