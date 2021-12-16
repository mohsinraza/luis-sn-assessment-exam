<?php

// wp_enqueue_script('chartjs', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js', [], '2.7.1', true);

wp_enqueue_script('simplenursing-vue-school-report-quizzes', get_stylesheet_directory_uri() . '/js/simplenursing-vue-school-report-quizzes.js', [], rand(), true);
?>


<div id="app-student-report-quizzes" class="text-center">

    <!-- main -->
    <main class="main--internal--schools">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Quizzes Report</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <b-card
                        class="mb-2 text-center"
                    >
                        <b-form inline @submit="onSubmit">
                            <b-form-datepicker
                            id="datepicker-start-date"
                            v-model="startDate"
                            class="mb-2 mr-2"
                            value-as-date
                            :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"

                            ></b-form-datepicker>
                            <b-form-datepicker
                            id="datepicker-end-date"
                            v-model="endDate"
                            class="mb-2 mr-2"
                            value-as-date
                            :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"

                            ></b-form-datepicker>

                            <b-button type="submit" :disabled="chartLoading" variant="primary">Run Reports</b-button>
                        </b-form>
                    </b-card>


                    <div class="row">
                        <div class="col-6">
                            <b-card
                                title="Total Quizzes Created"
                                class="mb-2 text-center"
                            >
                                <b-spinner v-if="chartLoading" label="Loading..." class="text-center"></b-spinner>
                                <h2 v-bind:class="{'d-none': chartLoading}" class="mb-0">{{totalQuizzesCreated}}</h2>
                            </b-card>
                        </div>
                        <div class="col-6">
                            <b-card
                                title="Global Quizzes Score"
                                class="mb-2 text-center"
                            >
                                <b-spinner v-if="chartLoading" label="Loading..." class="text-center"></b-spinner>
                                <h2 v-bind:class="{'d-none': chartLoading}" class="mb-0">{{globalQuizzesScore}}</h2>
                            </b-card>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <b-card
                                title="Quizzes Created by Day"
                                class="mb-2 text-center"
                            >
                                <b-spinner v-if="chartLoading" label="Loading..." class="text-center"></b-spinner>
                                <canvas v-bind:class="{'d-none': chartLoading}"  id="quizzesChart"></canvas>
                            </b-card>
                        </div>
                        <div class="col-6">
                            <b-card
                                title="Quizzes Score by Day"
                                class="mb-2 text-center"
                            >
                                <b-spinner v-if="chartLoading" label="Loading..." class="text-center"></b-spinner>
                                <canvas v-bind:class="{'d-none': chartLoading}"  id="quizzesScoreChart"></canvas>
                            </b-card>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</main>
<!-- /main -->
</div>
