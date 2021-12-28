<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#form"></a>
      Form
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Form consists of <code>input</code>, <code>radio</code>,
      <code>select</code>, <code>checkbox</code> and so on. With form, you can
      collect, verify and submit data.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicForm></EUIBasicForm>
  <EUIInlineForm></EUIInlineForm>
  <EUIAlignment></EUIAlignment>
  <EUIValidation></EUIValidation>
  <EUICustomValidationRules></EUICustomValidationRules>
  <EUIDeleteOrAddFormItemsDynamically></EUIDeleteOrAddFormItemsDynamically>
  <EUINumberValidate></EUINumberValidate>
  <EUISizeControl></EUISizeControl>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIBasicForm from "@/views/resources/documentation/element-ui/form/form/BasicForm.vue";
import EUIInlineForm from "@/views/resources/documentation/element-ui/form/form/InlineForm.vue";
import EUIAlignment from "@/views/resources/documentation/element-ui/form/form/Alignment.vue";
import EUIValidation from "@/views/resources/documentation/element-ui/form/form/Validation.vue";
import EUICustomValidationRules from "@/views/resources/documentation/element-ui/form/form/CustomValidationRules.vue";
import EUIDeleteOrAddFormItemsDynamically from "@/views/resources/documentation/element-ui/form/form/DeleteOrAddFormItemsDynamically.vue";
import EUINumberValidate from "@/views/resources/documentation/element-ui/form/form/NumberValidate.vue";
import EUISizeControl from "@/views/resources/documentation/element-ui/form/form/SizeControl.vue";

export default defineComponent({
  name: "form",
  components: {
    EUIBasicForm,
    EUIInlineForm,
    EUIAlignment,
    EUIValidation,
    EUICustomValidationRules,
    EUIDeleteOrAddFormItemsDynamically,
    EUINumberValidate,
    EUISizeControl
  },
  setup() {
    setCurrentPageTitle("Form");
  }
});
</script>
