<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#buttons-with-background-color"></a>
      Buttons with background color
    </h2>
    <!--end::Heading-->

    <div class="rounded border p-10">
      <el-pagination background layout="prev, pager, next" :total="1000">
      </el-pagination>

      <CodeHighlighter lang="html">{{ code3 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code3 } from "./data.ts";

export default defineComponent({
  name: "buttons-with-background-color",
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code3
    };
  }
});
</script>
