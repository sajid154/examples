<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#step-strictly"></a>
      Step strictly
    </h2>
    <!--end::Heading-->

    <div class="rounded border p-10">
      <el-input-number v-model="num" :step="2" step-strictly></el-input-number>

      <CodeHighlighter lang="html">{{ code4 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code4 } from "./data.ts";

export default defineComponent({
  name: "step-strictly",
  data() {
    return {
      num: 2
    };
  },
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code4
    };
  }
});
</script>
