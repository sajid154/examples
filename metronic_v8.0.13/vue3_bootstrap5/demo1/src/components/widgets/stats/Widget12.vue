<template>
  <!--begin::Mixed Widget 10-->
  <div class="card card-xxl-stretch-50 mb-5 mb-xl-8">
    <!--begin::Body-->
    <div
      class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden"
    >
      <div class="d-flex flex-stack flex-grow-1 px-9 pt-9 pb-3">
        <!--begin::Icon-->
        <div class="symbol symbol-45px">
          <div class="symbol-label">
            <span class="svg-icon svg-icon-2x svg-icon-primary">
              <inline-svg src="media/icons/duotone/Shopping/Chart-line1.svg" />
            </span>
          </div>
        </div>
        <!--end::Icon-->

        <!--begin::Text-->
        <div class="d-flex flex-column text-end">
          <span class="fw-bolder text-gray-800 fs-3">Sales</span>
          <span class="text-gray-400 fw-bold">Oct 8 - Oct 26 21</span>
        </div>
        <!--end::Text-->
      </div>

      <!--begin::Chart-->
      <apexchart
        class="mixed-widget-10-chart"
        :options="chartOptions"
        :series="series"
        type="bar"
        width="100%"
        height="168"
      ></apexchart>
      <!--end::Chart-->
    </div>
  </div>
  <!--end::Mixed Widget 10-->
</template>

<script>
import { defineComponent } from "vue";
import { getCSSVariableValue } from "@/assets/ts/_utils";

export default defineComponent({
  name: "widget-12",
  setup() {
    const labelColor = getCSSVariableValue("--bs-gray-500");
    const borderColor = getCSSVariableValue("--bs-gray-200");
    const secondaryColor = getCSSVariableValue("--bs-gray-300");
    const color = "primary";
    const baseColor = getCSSVariableValue("--bs-" + color);

    const chartOptions = {
      chart: {
        fontFamily: "inherit",
        type: "bar",
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ["50%"],
          endingShape: "rounded"
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"]
      },
      xaxis: {
        categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: "12px"
          }
        }
      },
      yaxis: {
        y: 0,
        offsetX: 0,
        offsetY: 0,
        labels: {
          style: {
            colors: labelColor,
            fontSize: "12px"
          }
        }
      },
      fill: {
        type: "solid"
      },
      states: {
        normal: {
          filter: {
            type: "none",
            value: 0
          }
        },
        hover: {
          filter: {
            type: "none",
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: "none",
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: "12px"
        },
        y: {
          formatter: function(val) {
            return "$" + val + " revenue";
          }
        }
      },
      colors: [baseColor, secondaryColor],
      grid: {
        padding: {
          top: 10
        },
        borderColor: borderColor,
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      }
    };
    const series = [
      {
        name: "Net Profit",
        data: [50, 60, 70, 80, 60, 50, 70, 60]
      },
      {
        name: "Revenue",
        data: [50, 60, 70, 80, 60, 50, 70, 60]
      }
    ];

    return {
      chartOptions,
      series
    };
  }
});
</script>
