<template>
  <!--begin::Section-->
  <div class="py-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-3" id="inline-usage">
      <a href="#inline-usage"></a>
      Inline Usage
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Use svg icons as inline svg element in order to customize the icon size
      and color via CSS:
    </div>
    <!--end::Block-->

    <!--begin::Block-->
    <div class="py-5">
      <div class="rounded border d-flex flex-wrap p-10">
        <span class="svg-icon svg-icon-3x me-10">
          <inline-svg src="media/icons/duotone/Design/Adjust.svg" />
        </span>
        <span class="svg-icon svg-icon-3x me-10">
          <inline-svg src="media/icons/duotone/Code/Git3.svg" />
        </span>
        <span class="svg-icon svg-icon-3x me-10">
          <inline-svg src="media/icons/duotone/Communication/Chat2.svg" />
        </span>
        <span class="svg-icon svg-icon-3x me-10">
          <inline-svg src="media/icons/duotone/Files/File-plus.svg" />
        </span>
        <span class="svg-icon svg-icon-3x me-10">
          <inline-svg src="media/icons/duotone/General/Settings-2.svg" />
        </span>
        <span class="svg-icon svg-icon-3x me-10">
          <inline-svg src="media/icons/duotone/Tools/Tools.svg" />
        </span>
        <span class="svg-icon svg-icon-3x me-10">
          <inline-svg src="media/icons/duotone/Shopping/Chart-bar3.svg" />
        </span>
      </div>
    </div>
    <!--end::Block-->

    <!--begin::Code-->
    <div class="py-5">
      <CodeHighlighter lang="html"
        >{{`<!--begin::Svg Icon | path: '.svg/icons/Design/Adjust.svg.'-->
        <span class="svg-icon svg-icon-3x"
          ><svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            width="24px"
            height="24px"
            viewBox="0 0 24 24"
            version="1.1"
          >
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24" />
              <path
                d="M12,20 C7.581722,20 4,16.418278 4,12 C4,7.581722 7.581722,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 Z M12,5.99999664 C8.6862915,6 6,8.6862915 6,12 C6,15.3137085 8.6862915,18 12,18.0000034 L12,5.99999664 Z"
                fill="#000000"
                fill-rule="nonzero"
              />
            </g></svg
        ></span>
        <!--end::Svg Icon-->`}}</CodeHighlighter
      >
    </div>
    <!--end::Code-->
  </div>
  <!--end::Section-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import CodeHighlighter from "@/components/highlighters/CodeHighlighter.vue";

export default defineComponent({
  name: "inlne-usage",
  components: {
    CodeHighlighter
  }
});
</script>
