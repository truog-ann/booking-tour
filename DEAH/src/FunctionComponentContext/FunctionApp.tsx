import React, { useState, useEffect } from 'react';
import { DateRangePicker } from 'react-date-range';
import 'react-date-range/dist/styles.css'; // main style file
import 'react-date-range/dist/theme/default.css'; // theme css file
import '../App.css';
import { format } from 'date-fns';
import addDays from 'date-fns/addDays';

interface DateStarProps {
  tour_long: number;
  setStartDate: (date: string) => void;
  setEndDate: (date: string) => void;
}

const DateStar: React.FC<DateStarProps> = ({ tour_long, setStartDate, setEndDate }) => {
  const [openDate, setOpenDate] = useState(false);
  const [date, setDate] = useState({
    startDate: addDays(new Date(),2),
    endDate: addDays(addDays(new Date(),2), tour_long-1),
    key: 'selection',
  });

  useEffect(() => {
    // Ensure dates are valid before formatting
    if (date.startDate && date.endDate) {
      const formattedstartDate = format(date.startDate, 'yyyy-MM-dd');
      const formattedendDate = format(date.endDate, 'yyyy-MM-dd');
      setStartDate(formattedstartDate);
      setEndDate(formattedendDate);
    }
  }, [date.startDate, date.endDate, setStartDate, setEndDate]);

  const handleChange = (ranges: any) => {
    const { startDate, endDate } = ranges.selection;
    if (startDate && endDate) {
      const adjustedEndDate = addDays(startDate, tour_long-1);

      if (adjustedEndDate >= startDate) {
        setDate({
          startDate,
          endDate: adjustedEndDate,
          key: 'selection',
        });
      } else {
        setDate({
          startDate,
          endDate: startDate,
          key: 'selection',
        });
      }
    }
  };
  const minDate = new Date();
  minDate.setDate(minDate.getDate() + 2);

  const handleClick = () => {
    setOpenDate((prev) => !prev);
  };

  return (
    <div className=''>
      <span className='select2-title' onClick={handleClick}>
        {format(date.startDate, 'MMM dd, yyyy')} - {format(date.endDate, 'MMM dd, yyyy')}
      </span>
   <div className='h'>
   {openDate && (
        <DateRangePicker
          className='dateRanger'
          ranges={[date]}
          onChange={handleChange}
          minDate={minDate}
        />
      )}
   </div>
    </div>
  );
};

export default DateStar;