<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#number-of-pagers"></a>
      Number of pagers
    </h2>
    <!--end::Heading-->

    <div class="rounded border p-10">
      <el-pagination
        :page-size="20"
        :pager-count="11"
        layout="prev, pager, next"
        :total="1000"
      >
      </el-pagination>

      <CodeHighlighter lang="html">{{ code2 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code2 } from "./data.ts";

export default defineComponent({
  name: "number-of-pagers",
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
