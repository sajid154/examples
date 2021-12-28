<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#basic-usage"></a>
      Basic usage
    </h2>
    <!--end::Heading-->

    <div class="rounded border p-10">
      <el-input placeholder="Please input" v-model="input"></el-input>

      <CodeHighlighter lang="html">{{ code1 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code1 } from "./data.ts";

export default defineComponent({
  name: "basic-usage",
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      input: ref(""),
      code1
    };
  }
});
</script>
