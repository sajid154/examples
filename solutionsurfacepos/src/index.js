import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import * as serviceWorker from "./serviceWorker";
import useLocalStorage from './hooks/useLocalStorage';

import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import {
  Navigation,
  TopMenu,
  Header,
  LeftBar,
  Content,
  Footer,
  Home,
  About,
  Add,
  AddForm,
  // BooksList,
  List,
  Buy,
  Contact,
  Blog,
  Posts,
  Post,
} from "./components";

ReactDOM.render(
  <Header />,

  document.getElementById("header")
);

ReactDOM.render(
  <Router>
  <TopMenu />
  <Navigation />
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/Add" element={<Add />} />
      <Route path="/List" element={<List />} />
      {/* <Route path="/BooksList" element={<BooksList />} /> */}
      <Route path="/Buy" element={<Buy />} />
      <Route path="/about" element={<About />} />
      <Route path="/contact" element={<Contact />} />
      <Route component={AddForm} path="/add" />
      <Route path="/blog" element={<Blog />}>
        <Route path="" element={<Posts />} />
        <Route path=":postSlug" element={<Post />} />
      </Route>
    </Routes>
  </Router>,

  document.getElementById("top_menu")
);

ReactDOM.render(
  <Router>
    This is left bar...
  </Router>,

  document.getElementById("left-bar")
);

ReactDOM.render(
  <Content />,

  document.getElementById("root")
);

ReactDOM.render(
  <Footer />
  ,

  document.getElementById("footer")
);

serviceWorker.unregister();
