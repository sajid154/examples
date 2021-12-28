<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#basic-multiple-select"></a>
      Basic multiple select
    </h2>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Basic multiple select
    </div>
    <!--end::Block-->

    <div class="rounded border p-10">
      <el-select v-model="value1" multiple placeholder="Select">
        <el-option
          v-for="item in options"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        >
        </el-option>
      </el-select>

      <el-select
        v-model="value2"
        multiple
        collapse-tags
        style="margin-left: 20px;"
        placeholder="Select"
      >
        <el-option
          v-for="item in options"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        >
        </el-option>
      </el-select>

      <CodeHighlighter :field-height="400" lang="html">{{
        code5
      }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code5 } from "./data.ts";

export default defineComponent({
  name: "basic-multiple-select",
  data() {
    return {
      options: [
        {
          value: "Option1",
          label: "Option1"
        },
        {
          value: "Option2",
          label: "Option2"
        },
        {
          value: "Option3",
          label: "Option3"
        },
        {
          value: "Option4",
          label: "Option4"
        },
        {
          value: "Option5",
          label: "Option5"
        }
      ],
      value1: [],
      value2: []
    };
  },
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code5
    };
  }
});
</script>
