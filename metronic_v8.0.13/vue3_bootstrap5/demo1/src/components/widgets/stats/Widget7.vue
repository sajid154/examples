<template>
  <!--begin::Mixed Widget 7-->
  <div class="card card-xxl-stretch-50 mb-5 mb-xl-8">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column p-0">
      <!--begin::Stats-->
      <div class="flex-grow-1 card-p pb-0">
        <div class="d-flex flex-stack flex-wrap">
          <div class="me-2">
            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3"
              >Generate Reports</a
            >

            <div class="text-muted fs-7 fw-bold">
              Finance and accounting reports
            </div>
          </div>

          <div class="fw-bolder fs-3 text-primary">
            $24,500
          </div>
        </div>
      </div>
      <!--end::Stats-->

      <!--begin::Chart-->
      <apexchart
        class="mixed-widget-7-chart card-rounded-bottom"
        :options="chartOptions"
        :series="series"
        type="area"
        width="100%"
        height="150"
      ></apexchart>
      <!--end::Chart-->
    </div>
    <!--end::Body-->
  </div>
  <!--end::Mixed Widget 7-->
</template>

<script>
import { defineComponent } from "vue";
import { useStore } from "vuex";

export default defineComponent({
  name: "widget-7",
  setup() {
    const store = useStore();

    const chartOptions = {
      chart: {
        fontFamily: "inherit",
        type: "area",
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: "solid",
        opacity: 1
      },
      stroke: {
        curve: "smooth",
        show: true,
        width: 3,
        colors: ["#27a5f7"]
      },
      xaxis: {
        categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          show: false,
          style: {
            colors: store.getters.layoutConfig("colors.gray.gray-500"),
            fontSize: "12px"
          }
        },
        crosshairs: {
          show: false,
          position: "front",
          stroke: {
            color: store.getters.layoutConfig("colors.gray.gray-300"),
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: false
        }
      },
      yaxis: {
        min: 0,
        max: 60,
        labels: {
          show: false,
          style: {
            colors: store.getters.layoutConfig("colors.gray.gray-500"),
            fontSize: "12px"
          }
        }
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
            return "$" + val + " thousands";
          }
        }
      },
      colors: ["#ecf8ff"],
      markers: {
        colors: ["#ecf8ff"],
        strokeColor: ["#27a5f7"],
        strokeWidth: 3
      }
    };
    const series = [
      {
        name: "Net Profit",
        data: [15, 25, 15, 40, 20, 50]
      }
    ];

    return {
      chartOptions,
      series
    };
  }
});
</script>
