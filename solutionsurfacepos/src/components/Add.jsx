import React from 'react';
import AddForm from './AddForm';

const Add = () => {
  const handleOnSubmit = (book) => {
    console.log(book);
  };

  return (
    <React.Fragment>
      <AddForm handleOnSubmit={handleOnSubmit} />
    </React.Fragment>
  );
};

export default Add;