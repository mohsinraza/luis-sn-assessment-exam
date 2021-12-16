<?php

// wp_enqueue_script('chartjs', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js', [], '2.7.1', true);

wp_enqueue_script('simplenursing-vue-school-report-study-guides', get_stylesheet_directory_uri() . '/js/simplenursing-vue-school-report-study-guides.js', [], rand(), true);
?>


<div id="app-student-report-study-guides" class="text-center">

    <!-- main -->
    <main class="main--internal--schools">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Study Guides Reports</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <b-card
                        class="mb-2 text-center"
                    >
                        <b-form inline @submit="onSubmit">
                            <b-button :disabled="chartLoading" type="submit" variant="primary">Run Report</b-button>
                        </b-form>
                    </b-card>


                    <div class="row">
                        <div class="col-12">
                            <b-card-group deck>
                                <b-card header="Total Study Guides downloaded by different students">
                                    <b-overlay
                                      :show="chartLoading"
                                      rounded
                                      opacity="0.6"
                                      spinner-small
                                      spinner-variant="primary"
                                    >
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
                                    </b-overlay>
                                </b-card>
                            </b-card-group>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</main>
<!-- /main -->
</div>
