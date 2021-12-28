import { createRouter, createWebHashHistory, RouteRecordRaw } from "vue-router";
import store from "@/store";
import { Mutations, Actions } from "@/store/enums/StoreEnums";

const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    redirect: "/dashboard",
    component: () => import("@/layout/Layout.vue"),
    children: [
      {
        path: "/dashboard",
        name: "dashboard",
        component: () => import("@/views/Dashboard.vue")
      },
      {
        path: "/builder",
        name: "builder",
        component: () => import("@/views/Builder.vue")
      },
      {
        path: "/crafted/pages/profile",
        name: "profile",
        component: () => import("@/views/pages/Profile.vue"),
        children: [
          {
            path: "overview",
            name: "profile-overview",
            component: () => import("@/views/pages/profile/Overview.vue")
          },
          {
            path: "projects",
            name: "profile-projects",
            component: () => import("@/views/pages/profile/Projects.vue")
          },
          {
            path: "campaigns",
            name: "profile-campaigns",
            component: () => import("@/views/pages/profile/Campaigns.vue")
          },
          {
            path: "documents",
            name: "profile-documents",
            component: () => import("@/views/pages/profile/Documents.vue")
          },
          {
            path: "connections",
            name: "profile-connections",
            component: () => import("@/views/pages/profile/Connections.vue")
          }
        ]
      },
      {
        path: "/crafted/pages/wizards/horizontal",
        name: "horizontal-wizard",
        component: () => import("@/views/pages/wizards/Horizontal.vue")
      },
      {
        path: "/crafted/pages/wizards/vertical",
        name: "vertical-wizard",
        component: () => import("@/views/pages/wizards/Vertical.vue")
      },
      {
        path: "/crafted/account",
        name: "account",
        component: () => import("@/views/account/Account.vue"),
        children: [
          {
            path: "overview",
            name: "account-overview",
            component: () => import("@/views/account/Overview.vue")
          },
          {
            path: "settings",
            name: "account-settings",
            component: () => import("@/views/account/Settings.vue")
          }
        ]
      },
      {
        path: "/apps/chat/private-chat",
        name: "apps-private-chat",
        component: () => import("@/views/chat/Chat.vue")
      },
      {
        path: "/apps/chat/group-chat",
        name: "apps-group-chat",
        component: () => import("@/views/chat/Chat.vue")
      },
      {
        path: "/apps/chat/drawer-chat",
        name: "apps-drawer-chat",
        component: () => import("@/views/chat/DrawerChat.vue")
      },
      {
        path: "/documentation",
        name: "documentation",
        component: () => import("@/views/resources/Documentation.vue"),
        children: [
          {
            path: "build",
            name: "build",
            component: () =>
              import("@/views/resources/documentation/get-started/Build.vue")
          },
          {
            path: "setup-theme-skeleton",
            name: "setup-theme-skeleton",
            component: () =>
              import(
                "@/views/resources/documentation/get-started/SetupThemeSkeleton.vue"
              )
          },
          {
            path: "doc-overview",
            name: "doc-overview",
            component: () =>
              import("@/views/resources/documentation/get-started/Overview.vue")
          },
          {
            path: "updates",
            name: "updates",
            component: () =>
              import("@/views/resources/documentation/get-started/Updates.vue")
          },
          {
            path: "changelog",
            name: "changelog",
            component: () => import("@/views/resources/Changelog.vue")
          },
          {
            path: "utilities",
            name: "utilities",
            meta: {
              desc: "extended utility classes"
            },
            component: () =>
              import("@/views/resources/documentation/base/Utilities.vue")
          },
          {
            path: "helpers/flex-layouts",
            name: "flex-layouts",
            meta: {
              desc: "extended flex layout classes"
            },
            component: () =>
              import(
                "@/views/resources/documentation/base/helpers/FlexLayouts.vue"
              )
          },
          {
            path: "helpers/text",
            name: "text",
            meta: {
              desc: "extended text classes"
            },
            component: () =>
              import("@/views/resources/documentation/base/helpers/Text.vue")
          },
          {
            path: "helpers/background",
            name: "backkground",
            meta: {
              desc: "extended background classes"
            },
            component: () =>
              import(
                "@/views/resources/documentation/base/helpers/Background.vue"
              )
          },
          {
            path: "helpers/borders",
            name: "borders",
            meta: {
              desc: "extended borders classes"
            },
            component: () =>
              import("@/views/resources/documentation/base/helpers/Borders.vue")
          },
          {
            path: "forms",
            name: "forms",
            meta: {
              desc: "forms elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Forms.vue")
          },
          {
            path: "buttons",
            name: "buttons",
            meta: {
              desc: "buttons elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Buttons.vue")
          },
          {
            path: "indicator",
            name: "indicator",
            meta: {
              desc: "indicator element"
            },
            component: () =>
              import("@/views/resources/documentation/base/Indicator.vue")
          },
          {
            path: "rotate",
            name: "rotate",
            meta: {
              desc: "Rotate element"
            },
            component: () =>
              import("@/views/resources/documentation/base/Rotate.vue")
          },
          {
            path: "tables",
            name: "tables",
            meta: {
              desc: "extended bootstrap tables"
            },
            component: () =>
              import("@/views/resources/documentation/base/Tables.vue")
          },
          {
            path: "cards",
            name: "cards",
            meta: {
              desc: "card elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Cards.vue")
          },
          {
            path: "symbol",
            name: "symbol",
            meta: {
              desc: "symbol elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Symbol.vue")
          },
          {
            path: "badges",
            name: "badges",
            meta: {
              desc: "badge elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Badges.vue")
          },
          {
            path: "pulse",
            name: "pulse",
            meta: {
              desc: "pulse elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Pulse.vue")
          },
          {
            path: "bullets",
            name: "bullets",
            meta: {
              desc: "bullets elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Bullets.vue")
          },
          {
            path: "accordion",
            name: "accordion",
            meta: {
              desc: "accordion elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Accordion.vue")
          },
          {
            path: "carousel",
            name: "carousel",
            meta: {
              desc: "carousel elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Carousel.vue")
          },
          {
            path: "overlay",
            name: "overlay",
            meta: {
              desc: "overlay elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Overlay.vue")
          },
          {
            path: "separator",
            name: "separator",
            meta: {
              desc: "separator elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Separator.vue")
          },
          {
            path: "tabs",
            name: "tabs",
            meta: {
              desc: "tabs elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Tabs.vue")
          },
          {
            path: "breadcrumb",
            name: "breadcrumb",
            meta: {
              desc: "breadcrumb elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Breadcrumb.vue")
          },
          {
            path: "modal",
            name: "modal",
            meta: {
              desc: "modal elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Modal.vue")
          },
          {
            path: "pagination",
            name: "pagination",
            meta: {
              desc: "pagination elements"
            },
            component: () =>
              import("@/views/resources/documentation/base/Pagination.vue")
          },
          {
            path: "vue-select",
            name: "vue-select",
            meta: {
              desc: "Vue multiselect"
            },
            component: () =>
              import("@/views/resources/documentation/forms/VueSelect.vue")
          },
          {
            path: "vee-validate",
            name: "vee-validate",
            meta: {
              desc: "Vee validate"
            },
            component: () =>
              import("@/views/resources/documentation/forms/VeeValidate.vue")
          },
          {
            path: "element-ui",
            name: "element-ui",
            component: () =>
              import(
                "@/views/resources/documentation/element-ui/ElementUI.vue"
              ),
            children: [
              {
                path: "basic/layout",
                name: "layout",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/basic/Layout.vue"
                  )
              },
              {
                path: "basic/layout-container",
                name: "layout-container",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/basic/LayoutContainer.vue"
                  )
              },
              {
                path: "basic/icon",
                name: "icon",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/basic/Icon.vue"
                  )
              },
              {
                path: "basic/button",
                name: "button",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/basic/Button.vue"
                  )
              },
              {
                path: "basic/link",
                name: "link",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/basic/Link.vue"
                  )
              },
              {
                path: "basic/space",
                name: "space",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/basic/Space.vue"
                  )
              },
              {
                path: "form/radio",
                name: "radio",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Radio.vue"
                  )
              },
              {
                path: "form/checkbox",
                name: "checkbox",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Checkbox.vue"
                  )
              },
              {
                path: "form/input",
                name: "input",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Input.vue"
                  )
              },
              {
                path: "form/input-number",
                name: "input-number",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/InputNumber.vue"
                  )
              },
              {
                path: "form/select",
                name: "select",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Select.vue"
                  )
              },
              {
                path: "form/cascader",
                name: "cascader",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Cascader.vue"
                  )
              },
              {
                path: "form/switch",
                name: "switch",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Switch.vue"
                  )
              },
              {
                path: "form/slider",
                name: "slider",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Slider.vue"
                  )
              },
              {
                path: "form/time-picker",
                name: "time-picker",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/TimePicker.vue"
                  )
              },
              {
                path: "form/time-select",
                name: "time-select",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/TimeSelect.vue"
                  )
              },
              {
                path: "form/date-picker",
                name: "date-picker",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/DatePicker.vue"
                  )
              },
              {
                path: "form/date-time-picker",
                name: "date-time-picker",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/DateTimePicker.vue"
                  )
              },
              {
                path: "form/upload",
                name: "upload",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Upload.vue"
                  )
              },
              {
                path: "form/rate",
                name: "rate",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Rate.vue"
                  )
              },
              {
                path: "form/color-picker",
                name: "color-picker",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/ColorPicker.vue"
                  )
              },
              {
                path: "form/transfer",
                name: "transfer",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Transfer.vue"
                  )
              },
              {
                path: "form/form",
                name: "form",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/form/Form.vue"
                  )
              },
              {
                path: "data/table",
                name: "table",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Table.vue"
                  )
              },
              {
                path: "data/tag",
                name: "tag",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Tag.vue"
                  )
              },
              {
                path: "data/progress",
                name: "progress",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Progress.vue"
                  )
              },
              {
                path: "data/tree",
                name: "tree",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Tree.vue"
                  )
              },
              {
                path: "data/pagination",
                name: "data-pagination",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Pagination.vue"
                  )
              },
              {
                path: "data/badge",
                name: "badge",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Badge.vue"
                  )
              },
              {
                path: "data/skeleton",
                name: "skeleton",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Skeleton.vue"
                  )
              },
              {
                path: "data/empty",
                name: "empty",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/data/Empty.vue"
                  )
              },
              {
                path: "notice/alert",
                name: "alert",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/notice/Alert.vue"
                  )
              },
              {
                path: "notice/loading",
                name: "loading",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/notice/Loading.vue"
                  )
              },
              {
                path: "notice/message",
                name: "message",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/notice/Message.vue"
                  )
              },
              {
                path: "notice/message-box",
                name: "message-box",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/notice/MessageBox.vue"
                  )
              },
              {
                path: "notice/notification",
                name: "notification",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/notice/Notification.vue"
                  )
              },
              {
                path: "navigation/affix",
                name: "affix",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/navigation/Affix.vue"
                  )
              },
              {
                path: "navigation/nav-menu",
                name: "nav-menu",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/navigation/NavMenu.vue"
                  )
              },
              {
                path: "navigation/tabs",
                name: "navigation-tabs",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/navigation/Tabs.vue"
                  )
              },
              {
                path: "navigation/breadcrumb",
                name: "navigation-breadcrumb",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/navigation/Breadcrumb.vue"
                  )
              },
              {
                path: "navigation/page-header",
                name: "page-header",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/navigation/PageHeader.vue"
                  )
              },
              {
                path: "navigation/dropdown",
                name: "dropdown",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/navigation/Dropdown.vue"
                  )
              },
              {
                path: "navigation/steps",
                name: "steps",
                component: () =>
                  import(
                    "@/views/resources/documentation/element-ui/navigation/Steps.vue"
                  )
              }
            ]
          },
          {
            path: "icons/duotone",
            name: "duotone",
            meta: {
              desc: "duotone svg icons"
            },
            component: () =>
              import("@/views/resources/documentation/general/Duotone.vue")
          },
          {
            path: "icons/bootstrap-icons",
            name: "bootstrap-icons",
            meta: {
              desc: "free, high quality, open source icon library"
            },
            component: () =>
              import(
                "@/views/resources/documentation/general/BootstrapIcons.vue"
              )
          },
          {
            path: "icons/font-awesome",
            name: "font-awesome",
            meta: {
              desc: "awesome font icons"
            },
            component: () =>
              import("@/views/resources/documentation/general/FontAwesome.vue")
          },
          {
            path: "icons/line-awesome",
            name: "line-awesome",
            meta: {
              desc: "line font icons"
            },
            component: () =>
              import("@/views/resources/documentation/general/LineAwesome.vue")
          }
        ]
      }
    ]
  },
  {
    path: "/sign-in",
    name: "sign-in",
    component: () => import("@/views/auth/SignIn.vue")
  },
  {
    path: "/sign-up",
    name: "sign-up",
    component: () => import("@/views/auth/SignUp.vue")
  },
  {
    path: "/password-reset",
    name: "password-reset",
    component: () => import("@/views/auth/PasswordReset.vue")
  },
  {
    // the 404 route, when none of the above matches
    path: "/404",
    name: "404",
    component: () => import("@/views/error/Error404.vue")
  },
  {
    path: "/500",
    name: "500",
    component: () => import("@/views/error/Error500.vue")
  },
  {
    path: "/:pathMatch(.*)*",
    redirect: "/404"
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

router.beforeEach(() => {
  // reset config to initial state
  store.commit(Mutations.RESET_LAYOUT_CONFIG);

  store.dispatch(Actions.VERIFY_AUTH);

  // Scroll page to top on every route change
  setTimeout(() => {
    window.scrollTo(0, 0);
  }, 100);
});

export default router;
