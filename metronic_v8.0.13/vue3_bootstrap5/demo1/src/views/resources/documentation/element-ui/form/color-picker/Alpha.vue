<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#alpha"></a>
      Alpha
    </h2>
    <!--end::Heading-->

    <div class="rounded border p-10">
      <el-color-picker v-model="color" show-alpha></el-color-picker>

      <CodeHighlighter lang="html">{{ code2 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code2 } from "./data.ts";

export default defineComponent({
  name: "alpha",
  data() {
    return {
      color: "rgba(19, 206, 102, 0.8)"
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
