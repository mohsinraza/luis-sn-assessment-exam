<?php
    wp_enqueue_script('simplenursing-vue-videos-tree', get_stylesheet_directory_uri() . '/js/component-school-videos-tree.vue.js', ['vue-js'], rand(), true);
    wp_enqueue_script('sn-vue-component-create-video-assignment', get_stylesheet_directory_uri() . '/js/component-school-create-video-assignment.vue.js', ['vue-js'], rand(), true);
    wp_enqueue_script('simplenursing-vue-school-assignments', get_stylesheet_directory_uri() . '/js/simplenursing-vue-school-assignments.js', ['simplenursing'], rand(), true);
?>

<div id="app-assignments">
    <main class="main--internal--schools">
      <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Assignments</h1>
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

                <div class="mt-2">
                    <b-button class="btn-primary" size="sm" @click="openModalAddVideoAssignments">Create Video Assignment</b-button>
                </div>

            </div>

        </div>
      </div>

    </main>

    <?php get_template_part('template-parts/school-management/students/modal-video-assignment'); ?>

</div>
