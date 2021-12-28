<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#button-content"></a>
      Bottom content
    </h2>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Use the default slot to insert content at the bottom.
    </div>
    <!--end::Block-->

    <div class="rounded border p-10">
      <el-empty>
        <el-button type="primary">Button</el-button>
      </el-empty>

      <CodeHighlighter lang="html">{{ code4 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter";
import { code4 } from "./data.ts";

export default defineComponent({
  name: "button-content",
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
