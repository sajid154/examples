<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#message-box"></a>
      MessageBox
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      A set of modal boxes simulating system message box, mainly for alerting
      information, confirm operations and prompting messages.
    </div>
    <!--end::Block-->

    <div class="py-5">
      <div class="rounded py-5 px-5 bg-light-info">
        By design MessageBox provides simulations of system's
        <code>alert</code>, <code>confirm</code> and <code>prompt</code>，so
        it's content should be simple. For more complicated contents, please use
        Dialog.
      </div>
    </div>
  </div>
  <EUIAlert></EUIAlert>
  <EUIConfirm></EUIConfirm>
  <EUIPrompt></EUIPrompt>
  <EUICustomization></EUICustomization>
  <EUIUseHTMLString></EUIUseHTMLString>
  <EUIDistinguishingCancelAndClose></EUIDistinguishingCancelAndClose>
  <EUICenteredContent></EUICenteredContent>
</template>

<script>
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIAlert from "@/views/resources/documentation/element-ui/notice/message-box/Alert.vue";
import EUIConfirm from "@/views/resources/documentation/element-ui/notice/message-box/Confirm.vue";
import EUIPrompt from "@/views/resources/documentation/element-ui/notice/message-box/Prompt.vue";
import EUICustomization from "@/views/resources/documentation/element-ui/notice/message-box/Customization.vue";
import EUIUseHTMLString from "@/views/resources/documentation/element-ui/notice/message-box/UseHTMLString.vue";
import EUIDistinguishingCancelAndClose from "@/views/resources/documentation/element-ui/notice/message-box/DistinguishingCancelAndClose.vue";
import EUICenteredContent from "@/views/resources/documentation/element-ui/notice/message-box/CenteredContent.vue";

export default defineComponent({
  name: "message-box",
  components: {
    EUIAlert,
    EUIConfirm,
    EUIPrompt,
    EUICustomization,
    EUIUseHTMLString,
    EUIDistinguishingCancelAndClose,
    EUICenteredContent
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("MessageBox");
    });
  }
});
</script>
