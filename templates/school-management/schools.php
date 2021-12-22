<?php
    // VUE
    wp_enqueue_script('vue-js', get_stylesheet_directory_uri() . '/vendors/vue.min.js', [], '2.6.11');
    // AXIOS
    wp_enqueue_script( 'axios', get_stylesheet_directory_uri() . '/vendors/axios.min.js', [], '0.19.2 ');
    wp_enqueue_script('bootstrap-vue', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.21.2/bootstrap-vue.min.js', ['vue-js']);
    wp_enqueue_style('bootstrap-vue', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.21.2/bootstrap-vue.min.css', ['wp-bootstrap-starter-bootstrap-css']);
    wp_enqueue_script('simplenursing', get_stylesheet_directory_uri() . '/js/simplenursing.js', ['jquery'], rand(), true);
    wp_enqueue_script('class-api-schools', get_stylesheet_directory_uri() . '/js/class-api-schools.js', [], rand(), true);
    wp_enqueue_script('simplenursing-vue-schools', get_stylesheet_directory_uri() . '/js/simplenursing-vue-schools.js', [], rand(), true);
?>

<div id="app-schools">
    <main class="main--internal--schools">
      <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Schools</h1> 
            </div>
            <div class="col-6 mt-2">
                <b-button v-b-modal.modal-create-school variant="primary" class="float-right" >Add New School</b-button>
                <b-modal
                    id="modal-create-school"
                    ref="modal"
                    title="Submit School Info"
                    @show="resetModal"
                    @hidden="resetModal"
                    @ok="handleOk"
                    >
                    <form ref="form" @submit.stop.prevent="handleSubmit">
                        <!-- School Name -->
                        <b-form-group
                        label-cols-sm="4"
                        label-cols-lg="3"
                        content-cols-sm
                        content-cols-lg="7"
                        label="School Name"
                        label-for="school-name-input"
                        invalid-feedback="School Name is required"
                        :state="checkFormValidity"
                        >
                            <b-form-input
                                id="school-name-input"
                                v-model="schoolName"
                                :state="schoolNameState"
                                required
                            ></b-form-input>
                        </b-form-group>

                        <!-- Premium -->
                        <b-form-group 
                        label-cols-sm="4"
                        label-cols-lg="3"
                        content-cols-sm
                        content-cols-lg="7"
                        label="Premium"
                        label-for="premium-input"
                        invalid-feedback="Premium is required"
                        :state="checkFormValidity" 
                        v-slot="{ ariaDescribedby }"
                        >
                            <b-form-radio-group
                                id="premium-input"
                                v-model="premium"
                                :state="premiumState"
                                required
                                :options="options"
                                :aria-describedby="ariaDescribedby"
                                button-variant="outline-primary"
                                name="radio-btn-outline"
                                buttons
                            ></b-form-radio-group>
                        </b-form-group>

                        <!-- NCLEX -->
                        <b-form-group 
                        label-cols-sm="4"
                        label-cols-lg="3"
                        content-cols-sm
                        content-cols-lg="7"
                        label="NCLEX"
                        label-for="nclex-input"
                        invalid-feedback="NCLEX is required"
                        :state="checkFormValidity"
                        v-slot="{ ariaDescribedby }"
                        >
                            <b-form-radio-group
                                id="nclex-input"
                                v-model="nclex"
                                :state="nclexState"
                                required
                                :options="options"
                                :aria-describedby="ariaDescribedby"
                                button-variant="outline-primary"
                                name="radio-btn-outline"
                                buttons
                            ></b-form-radio-group>
                        </b-form-group>

                        <!-- Students Limit -->
                        <b-form-group
                        label-cols-sm="4"
                        label-cols-lg="3"
                        content-cols-sm
                        content-cols-lg="7"
                        label="Students Limit"
                        label-for="students-limit-input"
                        invalid-feedback="Students Limit is required"
                        :state="checkFormValidity"
                        >
                            <b-form-input
                                id="students-limit-input"
                                v-model="studentsLimit"
                                :state="studentsLimitState"
                                required
                            ></b-form-input>
                        </b-form-group>
                    </form>
                    <!-- Custom Fotter Buttons -->
                    <template #modal-footer="{ ok, cancel }">
                        <!-- Emulate built in modal footer ok and cancel button actions -->
                        <b-button variant="danger" @click="cancel()">
                            Cancel
                        </b-button>
                        <b-button variant="success" @click="ok()">
                            Submit
                        </b-button>
                        </template>
                </b-modal>
            </div>
        </div>

        <div class="row">
            <!-- cards_cta__item -->
            <div class="col-12">
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

                <!-- <div class="mt-3">
                    <b-button-group>
                        <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="">Create New School</b-button>
                    </b-button-group>
                </div> -->


            </div>

        </div>
      </div>

    </main>


</div>
