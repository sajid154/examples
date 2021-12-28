<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#basic-usage"></a>
      Basic usage
    </h2>
    <!--end::Heading-->

    <div class="rounded border p-10">
      <el-input-number
        v-model="num"
        @change="handleChange"
        :min="1"
        :max="10"
      ></el-input-number>

      <CodeHighlighter lang="html">{{ code1 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code1 } from "./data.ts";

export default defineComponent({
  name: "basic-usage",
  components: {
    CodeHighlighter
  },
  data() {
    return {
      num: 1
    };
  },
  methods: {
    handleChange(value) {
      console.log(value);
    }
  },
  setup() {
    return {
      code1
    };
  }
});
</script>
