import React from "react";
import $ from 'jquery';
import { Container, Row, Col } from 'react-grid';

// import pos from '../../public/assets/js/custom.js';
const mylib = window.mylib;
function Buy() {
  window.ssPos('Buy');
  // alert($('.img-fluid').html())

    return (
    <div className="about">
      <div class="container">
        <div class="row align-items-center my-5">
          <div class="col-lg-7">
            <img
              class="img-fluid rounded mb-4 mb-lg-0"
              src="http://placehold.it/900x400"
              alt=""
            />
          </div>
          <div class="col-lg-5">
            <h1 class="font-weight-light"></h1>
            <p>
              This is from src/components/Buy.jsx
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Buy;
