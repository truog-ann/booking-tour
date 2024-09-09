import React, { useEffect, useState } from 'react';

import CurrencyFormatter from '../FunctionComponentContext/CurrencyFormatter';
import axios from 'axios';
import '../App1.css';
import DateStar from '../FunctionComponentContext/FunctionApp';
import addDays from 'date-fns/addDays';

import Payment_PT from '../FunctionComponentContext/Pament_PT';
import { useNavigate } from 'react-router-dom';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import Header from '../components/Header';
import UserPicker from '../components/You';
import Footer from '../components/Footer';
const Ab: React.FC = () => {
  // const data= localStorage.getItem('user')
  // console.log(data);

  const [username, setUserName] = useState<string>('');
  const [phone, setPhone] = useState<string>('');
  const [email, setEmail] = useState<string>('');
  const [hotel, setHotel] = useState<any>(null);
  const [adults, setAdults] = useState<number>(0);
  const [kids, setKids] = useState<number>(0);
  const [totalPrice, setTotalPrice] = useState<number>(0);
  const tourString = localStorage.getItem('tour');
  const tour = tourString ? JSON.parse(tourString) : null;
  const [filteredOptions] = useState<any[]>(tour ? tour.tour.hotels : []);
  const userString = sessionStorage.getItem('user');
  // console.log(userString);

  const user = userString ? JSON.parse(userString) : null;
  const user_id = user ? user.id : null;
  const [startDate, setStartDate] = useState<any>(new Date());
  const [endDate, setEndDate] = useState<any>(addDays(new Date(), tour.tour.day));


  const [children2To5, setChildren2To5] = useState<number>(0);
  const [children6To12, setChildren6To12] = useState<number>(0);
  const navigate = useNavigate();

  const [paymentMethod, setPaymentMethod] = useState<any>('VPGD');
  useEffect(() => {
    calculateTotalPrice(adults);
  }, [adults, kids, hotel]);

  const calculateTotalPrice = (adults: number) => {
    const tourprice = tour.tour.promotion ? tour.tour.promotion : tour.tour.price
    const adultPrice = tourprice // Giả sử giá cho mỗi người lớn
    const kidPrice = tourprice * 0.2; // Giả sử giá cho mỗi trẻ em là 20% giá người lớn
    const hotelPrice = hotel ? (hotel.promotion ? Number(hotel.promotion) : hotel.price) : 0;
    const newTotalPrice = (adults * adultPrice) + (children6To12 * kidPrice) + hotelPrice;
    setTotalPrice(newTotalPrice);
  };



  // Hàm để lấy dữ liệu từ sessionStorage và thiết lập trạng thái
  useEffect(() => {
    const userString = sessionStorage.getItem('user');
    if (userString) {
      const user = JSON.parse(userString); // Chuyển đổi chuỗi JSON thành đối tượng
      setUserName(user.name || '');
      setPhone(user.phone || '');
      setEmail(user.email || '');
    }
  }, []);
  const Payment = async () => {
    const user_payment_info = {
      'user_name': username,
      'email': email,
      'phone': phone,
      'start': startDate,
      'end': endDate,
    };
    //    console.log(user_payment_info.user_name);
    sessionStorage.setItem('user_payment_info', JSON.stringify(user_payment_info));


    const bookingData = {
      'booking_code': 'Tour' + Date.now(),
      'user_name': username,
      'email': email,
      'tour_id': tour.tour.id,
      'tour_name': tour.tour.title,
      'tour_price': tour.tour.promotion ? tour.tour.promotion : tour.tour.price,
      'tour_address': tour.tour.location.ward + ', ' + tour.tour.location.district + ',' + tour.tour.location.province,
      'hotel_name': hotel ? hotel.name : '',
      'hotel_price': hotel ? (hotel.promotion ? Number(hotel.promotion) : hotel.price) : 0,
      'hotel_address': hotel ? (hotel.address + ',' + tour.tour.location.province) : '',
      'book_price': totalPrice,
      'promotion_price': 0,
      'total_price': totalPrice + (hotel ? (hotel.promotion ? Number(hotel.promotion) : hotel.price) : 0),
      'people': children2To5 + children6To12 + adults,
      'start': startDate,
      'end': endDate,
      'status_tour': 0,
      'status_payment': 0,
      'type': tour.tour.type,
      'phone': phone,
      'kids': children2To5 + children6To12,
      // 'promotion': (tour.tour.price - tour.tour.promotion) + (hotel.price - hotel.promotion ?? 0) ?? 0,
      'adults': adults,
      'user_id': user_id,
      'kids0To5': children2To5,
      'Kids6To12': children6To12,
      'children2To5': children2To5,
      'children6To12': children6To12,

    }
    switch (paymentMethod) {
      case 'VPGD':
        var response = await axios.post('http://127.0.0.1:8000/api/client/cashpayment', bookingData);
        if (response.status === 200) {
          toast.success(response.data.message);
          navigate('/paymentpage', { state: { data: bookingData } })
        } else {
          toast.error(response.data.message);
        }

        break;

      case 'CKNH':
        var response = await axios.post('http://127.0.0.1:8000/api/client/bankingPayment', bookingData);
        if (response.status === 200) {
          console.log(response.data.message);

          toast.success(response.data.message);
          navigate('/paymentbanking', { state: { data: bookingData } })
        } else {
          toast.error(response.data.message);
        }

        break;

      case 'VNPAY':
        var response = await axios.post('http://127.0.0.1:8000/api/client/vnpayment', bookingData);
        window.location.href = response.data.data;
        break;
      default:
        break;
    }

  };

  const chooseHotel = (e: any) => {
    console.log(paymentMethod);

    let data = JSON.parse(e.target.value);
    setHotel(data);
  };

  const handleUserChange = (adults: number, children2To5: number, children6To12: number) => {
    const kids = children2To5 + children6To12;
    setChildren2To5(children2To5);
    setChildren6To12(children6To12);
    setAdults(adults);
    setKids(kids);
  };

  return (
    <div>
      <Header status={undefined} />
      <main>
        {/* Breadcrumbs Start */}
        <section className="breadcrumbs-area breadcrumb-bg">
          <div className="container">
            <h1 className="title wow fadeInUp" data-wow-delay="0.0s">Thanh Toán</h1>
            <div className="breadcrumb-text">
              <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                <ul className="breadcrumb listing">
                  <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                  <li className="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)" className="single active">Payment</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </section>
        {/*/ End-of Breadcrumbs*/}
        {/* Destination area Start */}
        <section className="tour-details-section section-padding2">
          <div className="tour-details-area">
            <div className="tour-details-container">
              <div className="container">
                <div className="details-heading mb-30">
                  <div className="d-flex flex-column">
                    <h4 className="title">{tour.tour.title}</h4>
                    <div className="d-flex flex-wrap align-items-center gap-30 mt-16">
                      <div className="location">
                        <i className="ri-map-pin-line" />
                        <div className="name">{tour.tour.location.province}</div>
                      </div>
                      <div className="divider" />
                      <div className="d-flex align-items-center flex-wrap gap-20">
                        <div className="count">
                          <i className="ri-time-line" />
                          <p className="pera mt-3">{tour.tour.day} ngày {tour.tour.day - 1 === 0 ? '' : (tour.tour.day - 1 + ' đêm')}</p>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div className="price-review">
                    <div className="d-flex gap-6  align-items-end">
                      <p className="light-pera">Giá tiền: </p>
                      <p className="text-lg font-bold "><CurrencyFormatter amount={tour.tour.promotion ? tour.tour.promotion : tour.tour.price} />/Người</p>


                    </div>
                  </div>
                </div>
                <div className="row g-4">
                  <div className="col-xl-8">
                    {/* Included Exclude */}
                    <div className="tour-include-exclude m-0 mb-30 radius-6">
                      <div className="includ-exclude-point">
                        <h4 className="title">Bao gồm</h4>
                        <ul>
                          {tour.tour.attributes?.map((attr: any) => (
                            <li key={attr.id}>
                              <strong> - {attr.attribute}</strong>
                            </li>
                          ))}
                        </ul>
                      </div>
                    </div>
                    {/*/ Included Exclude */}
                    {/* Payment Start */}
                    <div className="donation-payment">
                      {/* Payment */}
                      <div className="card-style box-shadow border-0">
                        <div className="row g-4">
                          <div className="col mb-4">
                            <label htmlFor="name">Họ và tên</label>
                            <input type="text" onChange={(e) => setUserName(e.target.value)} value={username} className="form-control" placeholder="Họ và Tên" aria-label="Họ và Tên" />
                          </div>
                        </div>
                        <div className="input-group col mb-4 ">
                          <div className="input-group-text">+84</div>
                          <input type="number" onChange={(e) => setPhone(e.target.value)} value={phone} className="form-control" placeholder="Số điện thoại" />
                        </div>
                        <div className="mb-4">
                          <label htmlFor="email">Email (Bắt Buộc)</label>
                          <input type="email" onChange={(e) => setEmail(e.target.value)} value={email} className="form-control" placeholder="you@example.com" aria-label="email" />
                        </div>
                        <div className="mb-4">
                          <label htmlFor="hotel">Chọn khách sạn</label>
                          <select className="form-select" onChange={(e) => chooseHotel(e)} style={{ maxHeight: '500px', overflowY: 'auto' }}>
                            <option value="">-- Hotel --</option>
                            {filteredOptions.map((option: any, index: any) => (
                              <option key={index} value={JSON.stringify(option)}>
                                {option.name}
                              </option>
                            ))}
                          </select>
                        </div>
                        {/* hình thức thanh toán chọn */}
                        <Payment_PT setPaymentMethod={setPaymentMethod} paymentMethod={paymentMethod} />
                        {/* hình thức thanh toán chọn */}
                      </div>
                    </div>
                    {/*End-of Payment */}
                  </div>
                  <div className="col-xl-4">
                    <div className="date-travel-card position-sticky top-0">
                      <div className="price-review">
                        <div className="d-flex gap-10 align-items-end">
                          <p className="light-pera">Tổng</p>
                          <p className="text-lg font-bold text-danger"><CurrencyFormatter amount={totalPrice} /></p>

                        </div>
                        <div className="rating">
                          <p className="pera">Giá thay đổi theo quy mô nhóm</p>
                        </div>
                      </div>
                      <h4 className="heading-card">Chọn Ngày và Khách du lịch </h4>
                      <div className="date-time-dropdown">
                        <DateStar tour_long={tour.tour.day} setStartDate={setStartDate} setEndDate={setEndDate} />
                      </div>
                      <div className="dropdown-section position-relative user-picker-dropdown">

                        <UserPicker onUserChange={handleUserChange} />
                      </div>
                      <div className="footer bg-transparent">
                        <h4 className="title">Hủy bỏ miễn phí</h4>
                        <p className="pera"> Lên đến 24 giờ trước</p>
                      </div>
                    </div>
                    <button className="btn-primary-submit w-100 mt-2" onClick={Payment}>Thanh Toán</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        {/*/ End-of Destination */}
      </main>
      {/* Footer Start */}
      <Footer />
      <div className="progressParent" id="back-top">
        <svg className="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
          <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
      </div>
      <div className="search-overlay" />
    </div>
  );
};

export default Ab;
