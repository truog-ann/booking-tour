import { useEffect, useState } from 'react';

const Longtour = () => {
  // const [tours, setTours] = useState([]);
  const [totalTours, setTotalTours] = useState(0);

  useEffect(() => {
    // Fetch dữ liệu từ API
    const fetchData = async () => {
      try {
        const response = await fetch(`${import.meta.env.VITE_BACKEND_URL}/api/client/get-tours-list`);
        const data = await response.json();
        if (data.status === 200) {
          // setTours(data.data.tours);
          setTotalTours(data.data.tours.length);
        }
      } catch (error) {
        console.error('Error fetching the tours data:', error);
      }
    };
    fetchData();
    console.log(fetchData);
  }, []);

  return (
    <div>
      <h4 className="title">Tổng có tất cả {totalTours} Tour du lịch</h4>
   
    </div>
  );
};

export default Longtour;
