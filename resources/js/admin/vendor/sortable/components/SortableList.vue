<script>
import { Sortable } from "@shopify/draggable";

function move(items, oldIndex, newIndex) {
  const itemRemovedArray = [
    ...items.slice(0, oldIndex),
    ...items.slice(oldIndex + 1, items.length)
  ];

  return [
    ...itemRemovedArray.slice(0, newIndex),
    items[oldIndex],
    ...itemRemovedArray.slice(newIndex, itemRemovedArray.length)
  ];
}

export default {
  props: {
    cancelUrl: "",
    postEndpoint: "",
    value: {
      required: true
    },
    itemClass: {
      default: "sortable-list-item"
    },
    handleClass: {
      default: "sortable-list-handle"
    }
  },

  provide() {
    return {
      sortableListItemClass: this.itemClass,
      sortableListHandleClass: this.handleClass
    };
  },

  mounted() {
    new Sortable(this.$el, {
      draggable: `.${this.itemClass}`,
      handle: `.${this.handleClass}`,
      mirror: {
        constrainDimensions: true
      }
    }).on("sortable:stop", ({ oldIndex, newIndex }) => {
      this.$emit("input", move(this.value, oldIndex, newIndex));
    });
  },

  methods: {
    save() {
      axios
        .post(this.postEndpoint, { sortable_array: this.value })
        .then(response => this.onSuccess(response.data));
    },

    onSuccess(data) {
      this.submiting = false;
      if (data.redirect) {
        window.location.replace(data.redirect);
      }
    }
  },

  render() {
    return this.$scopedSlots.default({
      items: this.value,
      save: this.save
    });
  }
};
</script>