<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#disabled"></a>
      Disabled
    </h2>
    <!--end::Heading-->

    <div class="rounded border p-10">
      <el-input-number v-model="num" :disabled="true"></el-input-number>

      <CodeHighlighter lang="html">{{ code2 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code2 } from "./data.ts";

export default defineComponent({
  name: "disabled",
  data() {
    return {
      num: 1
    };
  },
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code2
    };
  }
});
</script>
