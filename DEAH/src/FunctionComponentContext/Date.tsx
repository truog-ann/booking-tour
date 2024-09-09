import { useState } from 'react';
import { DateRangePicker } from 'react-date-range';
import 'react-date-range/dist/styles.css'; // main style file
import 'react-date-range/dist/theme/default.css'; // theme css file
import '../App.css'
import { format } from 'date-fns';

const DateApp = () => {
  const [openDate, setOpenDate] = useState(false);
  const [date, setDate] = useState({
    startDate: new Date(),
    endDate: new Date(),
    key: 'selection',
  });

  const handleChange = (ranges:any) => {
    setDate(ranges.selection);
  };

  const handleClick = () => {
    setOpenDate((prev) => !prev);
  };

  return (
    <div className='w-auto '>
      <span className='select2-title' onClick={handleClick}>
        {`${format(date.startDate, 'MMM, dd, yyyy')} - ${format(date.endDate, 'MMM, dd, yyyy')}`}
      </span>
      {openDate && (
        <DateRangePicker
          className='dateRanger'
          ranges={[date]}
          onChange={handleChange}
          minDate={new Date()}
        />
      )}
    </div>
  );
};

export default DateApp;