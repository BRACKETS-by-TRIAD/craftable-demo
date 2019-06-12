<template>
  <div class="row">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i>
          <span>Sort Items</span>
        </div>
        <div class="card-block">
          <div class="sortable-heading">
            <template v-for="(item, key) in filteredData[0]">
              <div :key="key" :class="{'id': key == 'id'}">{{ capitalize(key.replace(/_/g, ' ')) }}</div>
            </template>
          </div>
          <sortable-list v-model="filteredData" :post-endpoint="this.postUrl">
            <div class="sortable-list" slot-scope="{ items, save }">
              <sortable-item v-for="item in items" :key="item.id">
                <div>
                  <div>
                    <template v-for="(attr, index) in item">
                      <span :key="index" :class="{ 'id': index == 'id'}">{{attr}}</span>
                    </template>
                  </div>
                  <sortable-handle>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                      <path
                        fill-rule="evenodd"
                        d="M14 4h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zM8 4h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm6 6h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1zm-6 0h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1zm6 6h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1zm-6 0h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1z"
                      ></path>
                    </svg>
                  </sortable-handle>
                </div>
              </sortable-item>

              <div class="form-group">
                <a :href="cancelUrl" class="mr-3">Cancel</a>
                <button class="btn btn-primary" @click="save">Save</button>
              </div>
            </div>
          </sortable-list>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["data", "postUrl", "cancelUrl"],

  data() {
    return {
      contacts: this.data,
      filteredData: [],
    };
  },

  mounted() {
    this.filteredData = this.data.map(item => {
      delete item.resource_url;
      return item;
    });
  },

  methods: {
    capitalize(string) {
      return string && string[0].toUpperCase() + string.slice(1);
    }
  }
};
</script>

<style>
.sortable-heading {
  display: flex;
  font-weight: bold;
  padding: 10px 15px;
}
.sortable-heading div {
  width: 22%;
}
.sortable-heading .id{
  width: 10%;
}

.sortable-list .form-group {
  margin-top: 20px;
}

.sortable-list-item:nth-last-child(2) {
  border-bottom: 1px solid #f1f5f8;
}

.sortable-list-item {
  padding: 10px 15px;
  border-top: 1px solid #f1f5f8;
  background-color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.sortable-list-item  div {
  display: flex;
  flex: 1;
  align-items: center;
}
.sortable-list-item span {
  width: 22%;
  display: inline-block;
}

.sortable-list-item .id{
  width: 10%;
}

.sortable-list-item.draggable-source--is-dragging {
  background-color: #f1f5f8;
}

.sortable-list-item.draggable-source--is-dragging > * {
  opacity: 0;
}

.sortable-list-handle {
  margin-left: 0.5rem;
  height: 1.5rem;
  width: 1.5rem;
  cursor: move;
  color: #b8c2cc;
}
.sortable-list-handle:hover {
  color: #3d4852;
}
</style>

