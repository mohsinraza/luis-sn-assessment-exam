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
            <div class="col-12">
                <h1>Schools</h1>
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

                <div class="mt-3">
                    <b-button-group>
                        <b-button class="btn-primary" :disabled="selectedGroup.length==0" size="sm" @click="">Create New School</b-button>
                    </b-button-group>
                </div>


            </div>

        </div>
      </div>

    </main>


</div>
