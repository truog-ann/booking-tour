import React, { useState, useEffect } from 'react';
import { useQuery } from '@tanstack/react-query';
import axios from 'axios';
import { Link, useNavigate, useParams } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import '../App1.css';
import '../App.css';
import Footer from './Footer';
import Header from './Header';
import TourSbar from '../FunctionComponentContext/TourSbar';
import CurrencyFormatter from '../FunctionComponentContext/CurrencyFormatter';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import { Slide } from 'react-slideshow-image';
import Modal from 'react-bootstrap/Modal';
import Button from 'react-bootstrap/Button';
import { toast } from 'react-toastify';
import { format } from 'date-fns';



const TourDetails = () => {
  const page = 3
  const navigate = useNavigate();
  const { slug } = useParams();
  const [mainImage, setMainImage] = useState<string | null>(null);
  const [modalIsOpen, setModalIsOpen] = useState<boolean>(false);
  const [currentDay, setCurrentDay] = useState<any>(null);
  const [rating, setRating] = useState<number>(0);
  const [comments, setComments] = useState<any>([]);
  const [formData, setFormData] = useState({
    name: '',
    comments: '',
    rate: '',
    tour_id: ''
  });
  const formattedDate = (date: string | Date) => {
    // Check if date is valid
    const parsedDate = new Date(date);
    if (isNaN(parsedDate.getTime())) {
      return 'Invalid Date'; // or handle appropriately
    }
    
    return format(parsedDate, 'yyyy-MM-dd'); // Example format
  };
  let userData: any = sessionStorage.getItem('user');
  if (userData) {
    userData = JSON.parse(userData);
  }

  const [currentPage, setCurrentPage] = useState<number>(1);
  const [totalPages, setTotalPages] = useState<number>(1);

  console.log(slug);

  const { data, isLoading, error } = useQuery({
    queryKey: ['KEY_POST', slug],
    queryFn: async () => {
      try {
        const response = await axios.get(`${import.meta.env.VITE_BACKEND_URL}/api/client/get-tour-detail/${slug}`);
        console.log(response.data.data.tour.id); // Log dữ liệu API để kiểm tra
        localStorage.setItem('tour', JSON.stringify(response.data.data))
        return response.data.data;
      } catch (error) {
        navigate(-1);
        throw error; // Đẩy lỗi lên phía trên để xử lý
      }
    }
  });
  console.log(data);

  useEffect(() => {
    if (data?.tour?.images?.length > 0 && !mainImage) {
      setMainImage(data.tour.images[0].image);
    }
    if (data?.tour?.id) {
      if (userData) {
        setFormData((prevFormData) => ({
          ...prevFormData,
          'name': userData.name,
          tour_id: data.tour.id
        }));
      } else {
        setFormData((prevFormData) => ({
          ...prevFormData,
          tour_id: data.tour.id
        }));
      }

      console.log(`Updated formData.tour_id: ${data.tour.id}`); // Log khi formData được cập nhật
    }
    if (data?.tour?.comments) {

      setComments(data.tour.comments);
      setTotalPages(Math.ceil(data.tour.comments.length / page))
    }
  }, [data, mainImage, comments]);

  // phan trang
  const displayedComments = comments.slice((currentPage - 1) * page, currentPage * page);
  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };

  // đánh giá 
  const handleRating = (rate: number) => {
    setRating(rate);
    setFormData((formData) => ({
      ...formData,
      rate: rate.toString()
    }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    console.log('Submitting form data:', formData); // Log dữ liệu form trước khi gửi
    try {
      const response = await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/client/review-tour`, formData);
      console.log('Success:', response.data);

      // Thêm bình luận mới vào danh sách bình luận
      setComments((prevComments: any) => [...prevComments, response.data]);

      if (userData) {
        setFormData((prevFormData) => ({
          name: userData.name,
          comments: '',
          rate: '',
          tour_id: prevFormData.tour_id // Giữ lại tour_id sau khi gửi thành công
        }));
      } else {
        setFormData((prevFormData) => ({
          name: '',
          comments: '',
          rate: '',
          tour_id: prevFormData.tour_id // Giữ lại tour_id sau khi gửi thành công
        }));
      }

      setRating(0);
      navigate(`/tour-details/:${slug}`);
      toast.success('Bạn đã gửi bình luận thành công');
    } catch (error) {
      console.error('Error:', error);
      toast.error('Có lỗi gửi bình luận')
    }
  };



  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    var { name, value } = e.target;

    setFormData((prevFormData) => ({
      ...prevFormData,
      [name]: value
    }));
  };

  const openModal = (day: any) => {
    setCurrentDay(day);
    setModalIsOpen(true);
  };

  const closeModal = () => {
    setModalIsOpen(false);
    setCurrentDay(null);
  };

  const settings = {
    dots: true,
    infinite: true,
    speed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
  };

  if (isLoading) {
    return (
      <div className="spinner">
        <div className="blob blob-0" />
      </div>
    );
  }

  if (error) {
    return <div>Error: {error.message}</div>;
  }


  return (

    <div>
      <Header status={undefined} />
      <main>
        <section className="breadcrumbs-area breadcrumb-bg">
          <div className="container">
            <h1 className="title wow fadeInUp" data-wow-delay="0.0s">Chi tiết tour du lịch</h1>
            <div className="breadcrumb-text">
              <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                <ul className="breadcrumb listing">
                  <li className="breadcrumb-item single-list"><Link to="/" className="single">Trang chủ</Link></li>
                  <li className="breadcrumb-item single-list" aria-current="page">
                    <a href="javascript:void(0)" className="single active">Chi tiết tour du lịch</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </section>

        <section className="tour-details-section section-padding2">
          <div className="tour-details-area">
            {data.tour.images && data.tour.images.length > 0 && (
              <>
                <Slide {...settings}>
                  {data.tour.images.map((imageObj: any, index: any) => (
                    <div key={index} className="main-image">
                      <img
                        src={`${import.meta.env.VITE_BACKEND_URL}/${imageObj.image}`}
                        alt={`Slide ${index}`}
                        style={{ width: '90%' }}
                      />
                    </div>
                  ))}
                </Slide>
              </>
            )}
          </div>

          <div className="tour-details-container">
            <div className="container">
              <div className="details-heading" key={data.tour.id}>
                <div className="d-flex flex-column">
                  <h4 className="title">{data.tour.title}</h4>
                  <div className="d-flex flex-wrap align-items-center gap-30 mt-16">
                    <div className="location">
                      <i className="ri-map-pin-line" />
                      <div className="name"> {data.tour.location.district}, {data.tour.location.province}</div>
                    </div>
                    <div className="divider" />
                    <div className="d-flex align-items-center flex-wrap gap-20">
                      <div className="count">
                        <i className="ri-time-line" />
                        <p className="pera mt-3">{data.tour.day} Ngày {data.tour.day - 1} Đêm</p>
                      </div>
                      <div className="count">
                        <p className="pera"></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="price-review">
                  <div className="d-flex gap-10 align-items-end">
                    <p className="light-pera">Chỉ từ :</p>
                    <div className="price mb-3 d-flex justify-content-center ml-4">
                      <h6 className="text-danger fw-bold mr-2">Giá mới: <CurrencyFormatter amount={data.tour.promotion} /></h6>
                      <h6 className="text-muted text-decoration-line-through">Giá cũ: <CurrencyFormatter amount={data.tour.price} /></h6>
                    </div>
                  </div>
                  <div className="rating">
                    <p className="pera mr-5">Đánh giá: {data.tour.rate ? data.tour.rate.qty : 0}</p>
                    <p className="pera">{data.tour.rate ? data.tour.rate.rate : 0}</p>
                    <i className="ri-star-s-fill mb-3"></i>
                  </div>
                </div>
              </div>

              <div className="mt-30">
                <div className="row g-4">
                  <div className="col-xl-8 col-lg-7">
                    <div className="tour-details-content">
                      <h4 className="title">Về</h4>
                      <p className="pera">
                        <div dangerouslySetInnerHTML={{ __html: data.tour.description }} />
                      </p>
                    </div>
                    <div className="tour-include-exclude radius-6">
                      <div className="includ-exclude-point">
                        <h4 className="title">Thuộc tính</h4>
                        <ul>

                          {data.tour.attributes?.map((attr: any) => (
                            <li key={attr.id}>
                              <strong> - {attr.attribute}</strong>
                            </li>
                          ))}

                        </ul>
                      </div>
                      <div className="divider" />
                    </div>

                    {/* cmt_tour */}
                    <div className="tour-details-content mb-30 ">
                      <h4 className="title">Xem lịch trình của bạn tại đây</h4>
                      <div className="tour-details-content mb-30">


                        <div className="accordion" id="accordionExample">
                          {data.tour.itineraries?.map((day: any) => (
                            <div key={day.day}>
                              <a href="#" onClick={() => openModal(day)}>Ngày {day.day}:  {day.title}</a>
                            </div>
                          ))}

                          <Modal
                            show={modalIsOpen}
                            onHide={closeModal}
                            centered
                            dialogClassName="custom-modal-width"
                            size='xl'
                          >
                            <Modal.Header className='schedule-header' closeButton>
                              <Modal.Title>Lịch trình tour</Modal.Title>
                            </Modal.Header>
                            <Modal.Body className='schedule-body'>
                              {currentDay && (
                                <ul>
                                  <div className='text-black font-bold' dangerouslySetInnerHTML={{ __html: currentDay.itinerary }} />
                                  <li>Kết thúc tour</li>
                                </ul>
                              )}
                            </Modal.Body>
                            <Modal.Footer className='schedule-footer bg-white'>
                              <Button variant="secondary" onClick={closeModal}>Đóng</Button>
                            </Modal.Footer>
                          </Modal>
                        </div>
                      </div>

                    </div>
                    <hr />
                    <div className="row justify-content-center">
                      <div className="col-xl-7 col-lg-7">
                        <div className="section-title text-center mx-auto position-relative ">

                          <span className="title highlights">Nhận Xét Khách Hàng</span>
                        </div>
                      </div>
                    </div>
                    <div className="container comment">
                      <div className="col-md-12 col-lg-10">
                        <div className="row d-flex justify-content-center  ">
                          <div className="">

                            {displayedComments.map((comment: any, index: any) => (
                              <>
                                <div key={index} className="card-body">
                                  <div className="d-flex flex-start">

                                    <i className="rounded-circle shadow-1-strong me-3 icon"   ><i className='bi bi-person'></i></i>
                                    <div>
                                      <h6 className="fw-bold mb-1">{comment.name}</h6>
                                      <div className="d-flex align-items-center mb-3">
                                        <p className="mb-0">
                                          {/* Hiển thị ngày và trạng thái bình luận nếu có */}
                                          {formattedDate(new Date(comment.created_at)) || 'Ngày bình luận không xác định'}

                                        </p>

                                      </div>
                                      <p className="mb-0">{comment.comments}</p>
                                    </div>
                                  </div>
                                </div>
                                <hr />
                              </>
                            ))}
                            <ul className="pagination mt-4">
                              {Array.from({ length: totalPages }, (_, index) => (
                                <li className="page-item m-1" key={index + 1}>
                                  <button
                                    className="page-link btn"
                                    disabled={index + 1 === currentPage}
                                    onClick={() => handlePageChange(index + 1)}
                                  >
                                    {index + 1}
                                  </button>
                                </li>
                              ))}
                            </ul>

                          </div>
                        </div>
                      </div>
                    </div>


                    {/* cmt tour */}

                    <div className="row g-4   d-flex">
                      <div className="container mt-4">
                        <div className="col-12">

                        </div>

                        <div className="contact-card mt-40">
                          <h4 className="contact-heading">Viết bình luận của bạn</h4>
                          <form method="post" className="contact-form" onSubmit={handleSubmit}>
                            <div className="row g-4">
                              <div className="col-sm-12 text-center">
                                <input className="custom-form" type="text" placeholder="Nhập tên của bạn" readOnly={userData ? true : false} value={userData ? userData.name : formData.name} onChange={handleChange} name='name' />
                              </div>
                              <div className="col-sm-12">
                                <textarea className="custom-form-textarea" id="exampleFormControlTextarea1" rows={3} placeholder="Hãy để lại bình luận của bạn tại đây" defaultValue={""} value={formData.comments} onChange={handleChange} name='comments' />
                              </div>
                              {/* sao */}
                              <h4 className="contact-heading">Đánh giá về tour du lịch</h4>
                              <div className="rating-section d-flex">
                                {[1, 2, 3, 4, 5].map((star) => (

                                  <div className="rating-checkbox" key={star}>

                                    <input
                                      type="checkbox"
                                      id={`star${star}`}
                                      name="rate"
                                      value={formData.rate}
                                      checked={rating === star}
                                      onChange={() => handleRating(star)}
                                    />
                                    <label htmlFor={`star${star}`}>
                                      <svg xmlns="http://www.w3.org/2000/svg" width={14} height={13} viewBox="0 0 14 13" fill="none">
                                        <path
                                          d="M6.09749 0.891366C6.45972 0.132244 7.54028 0.132244 7.90251 0.891366L9.07038 3.33882C9.21616 3.64433 9.5066 3.85534 9.84221 3.89958L12.5308 4.25399C13.3647 4.36391 13.6986 5.39158 13.0885 5.97067L11.1218 7.83768C10.8763 8.07073 10.7653 8.41217 10.827 8.74502L11.3207 11.4115C11.4739 12.2386 10.5997 12.8737 9.86041 12.4725L7.47702 11.1789C7.1795 11.0174 6.8205 11.0174 6.52298 11.1789L4.13959 12.4725C3.40033 12.8737 2.52614 12.2386 2.67929 11.4115L3.17304 8.74502C3.23467 8.41217 3.12373 8.07073 2.87823 7.83768L0.911452 5.97067C0.301421 5.39158 0.635332 4.36391 1.46924 4.25399L4.15779 3.89958C4.4934 3.85534 4.78384 3.64433 4.92962 3.33882L6.09749 0.891366Z"
                                          fill={rating >= star ? "#FFB400" : "#ccc"}
                                        />
                                      </svg>
                                    </label>
                                  </div>
                                ))}
                              </div>
                              {/* sao */}
                            </div>
                            <div className="mt-40">
                              <button type="submit" className="send-btn"> Đăng bình luận </button>
                            </div>
                          </form>
                        </div>

                      </div>
                    </div>

                  </div>


                  <div className="col-xl-4 col-lg-5">
                    <div className="row">
                      <hr className="mb-4" />
                      <div className="d-grid gap-2">
                        <Link to={`/payment/${slug}`} className="btn btn-primary btn-lg" type="button">
                          Đặt Lịch Ngay
                        </Link>
                      </div>
                    </div>
                    <TourSbar />

                  </div>
                </div>


              </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </div>
  );
};

export default TourDetails;