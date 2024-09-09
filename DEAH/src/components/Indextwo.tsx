
import "../Style/main.js"

import { useEffect, useState } from 'react'
import axios from 'axios'
import 'react-date-range/dist/styles.css'; // main style file
import 'react-date-range/dist/theme/default.css'; // theme css file
import Header from "./Header.js";
import Footer from "./Footer.js";
import CurrencyFormatter from "../FunctionComponentContext/CurrencyFormatter.js";
import { Link } from "react-router-dom";
import '../App.css'
import { useNavigate } from 'react-router-dom';

import SearchListBill from "../FunctionComponentContext/Shearchbill.js";
const Indextwo = () => {
  const [tourFeature, setToursFeature] = useState<any>([]);
  const [tourNew, setToursNew] = useState<any>([]);
  const [postsNew, setPostsNew] = useState<any>([]);
  const [status, setStatus] = useState<boolean>(false); // State để lưu URL của ảnh
  const [selectedProvince, setSelectedProvince] = useState<any>(null);
  const [selectedType, setSelectedType] = useState<any>(null);
  const [tour, setTour] = useState<any>([]);

  const navigate = useNavigate();

  // console.log(selectedType);

  useEffect(() => {
    const fetchData = async () => {
      try {
        let tours_new = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-tours-new`;
        let tours_lists = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-tours-feature`;
        let posts = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-posts-new`;
        const [tourNew, tourFeature, postsNew] = await Promise.all([
          axios.get(tours_new),
          axios.get(tours_lists),
          axios.get(posts),


        ]);


        const response = await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/client/get-tours-list`

        );


        setTour(response.data.data);
        // console.log(response1.data.data);
        setStatus(!status);
        setToursNew(tourNew.data.data);
        // console.log(tourNew.data.data);

        setToursFeature(tourFeature.data.data);
        setPostsNew(postsNew.data.data);



      } catch (error) {
        if (error) return <div>loi...</div>
      }
    };
    fetchData();

  }, [selectedProvince, selectedType]);
  // console.log(selectedProvince);

  const handleSubmit = (e: any) => {
    e.preventDefault();
    navigate('/tour-list', {
      state: { province: selectedProvince, type_id: selectedType }


    });

  };

  return (

    <div>

      <div>
        <Header status={status} />
        <main>
          {/* Hero area S t a r t*/}
          <section className="hero-padding-two  position-relative banner">
            <video autoPlay muted loop id="background-video">
              <source src="/assets/images/videos/travel4.mp4" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
            <div className="container">
              <SearchListBill />
              <div className="row  g-4 align-items-center justify-content-between position-relative">
                <div className="col-xl-7 col-lg-6">
                  <div className="hero-caption-two position-relative">
                    <span className="highlights text-30 wow fadeInUp d-block p-1" data-wow-delay="0.0s">Khám Phá Ngay</span>
                    <div className="hero-content">
                      <h4 className="title wow fadeInUp fs-1 p-1 " data-wow-delay="0.1s">  Kế  hoạch  chuyến  tham  quan  đến  các  địa  điểm  mơ  ước  chỉ  bằng  một  cú  nhấp  chuột ! </h4>
                      <p className="pera wow fadeInUp" data-wow-delay="0.3s">
                        Tận hưởng từng khoảnh khắc tại các địa điểm mơ ước, tham gia các hoạt động thú vị và lưu giữ những kỷ niệm đẹp.<br />
                      </p>
                    </div>

                    <div className="button-section wow fadeInUp" data-wow-delay="0.5s">
                      <a href="/tour-list" className="btn-secondary-sm hero-book-btn">Bắt đầu đặt phòng</a>
                    </div>
                  </div>
                </div>
                <div className="col-xl-5 col-lg-6 relative">
                  <div className="search-tour-card sidenav-active">
                    <div className="section-title text-center">
                      <h4 className="title">Tìm kiếm các tour du lịch</h4>
                      <p className="pera">Hãy nhập những thông tin dưới đây .</p>
                    </div>
                    <form action="" onSubmit={handleSubmit}>
                      <div className="plan-section-two">
                        <div className="select-dropdown-section">
                          <div className="d-flex gap-10 align-items-center">
                            <i className="ri-map-pin-line" />
                            <h4 className="select2-title">Điểm đến</h4>
                          </div>
                          <select className="rounded destination-dropdown" onChange={(e) => setSelectedProvince(e.target.value)} >
                            <option className='rounded' value=''>Lọc theo điểm đến</option>
                            {tour.provinces?.map((province: any) => {
                              return (
                                <option value={province.id}>{province.name}</option>
                              )
                            })}
                          </select>

                        </div>
                        <div className="select-dropdown-section">
                          <div className="d-flex gap-10 align-items-center">
                            <i className="ri-flight-takeoff-fill" />
                            <h4 className="select2-title">Tour Type</h4>
                          </div>
                          <select className="destination-dropdown rounded" onChange={(e) => setSelectedType(e.target.value)}>
                            <option value=''>Lọc theo loại du lịch</option>
                            {tour.types?.map((type: any) => {
                              return (
                                <option value={type.id}>{type.name_type}</option>
                              )
                            })}
                          </select>
                        </div>

                        <div className="dropdown-section position-relative user-picker-dropdown">
                          <div className="d-flex gap-10 align-items-center">
                          </div>

                        </div>
                        <div className="sign-btn">
                          <button type="submit" className="btn-secondary-lg">Tìm Kiếm</button>

                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            {/* shape 01 */}
            {/* shape 02 */}

          </section>
          {/*/ End-of Hero*/}
          {/* Brand S t a r t */}
          <section className="why-area">

            {/*  */}

          </section>
          {/*/ End of Brand */}
          {/* Special area S t a r t */}


          {/* Destination area S t a r t */}
          <section className="destination-section-two bottom-padding1">
            <div className="destination-area-two position-relative">
              <div className="container">
                <div className="row justify-content-center">
                  <div className="col-xl-7 col-lg-7">
                    <div className="section-title text-center mx-430 mx-auto position-relative">
                      <span className="highlights text-30">Danh sách tour mới nhất</span>
                      <h4 className="title">
                        Chúng tôi cung cấp các điểm đến du lịch hàng đầu
                      </h4>
                    </div>
                  </div>
                </div>

                <div className="row g-4">


                  {tourNew?.map((tours: any, index: any) => {
                    return (
                      <div className="col-xl-3 col-lg-4 col-sm-6" key={index}>
                        <Link to={`/tour-details/${tours.slug}`} className="destination-banner-two h-calc wow fadeInUp" data-wow-delay="0.s">
                          <img className="" src={`${import.meta.env.VITE_BACKEND_URL}/` + (tours.images ? tours.images : '')} alt="travello" />
                          <div className="destination-content-two">

                            <div className="destination-info-two">
                              <div className="destination-name line-clamp-2">

                                <Link className="pera" to={`/tour-details/${tours.slug}`}>{tours.title}</Link>
                              </div>
                              <div className="button-section">
                                <div className="arrow"><i className="ri-arrow-right-line" /></div>
                              </div>
                            </div>
                          </div>
                        </Link>
                      </div>
                    )
                  })}

                </div>
              </div>
            </div>
          </section>
          {/*/ End-of Destination */}
          {/* About Us area S t a r t */}
          <section className="about-area-two about-bg-before section-padding">
            <div className="container">
              <div className="row align-items-center position-relative">
                <div className="col-lg-8">
                  <div className="section-title mx-526 mb-30">
                    <span className="highlights text-30">về chúng tôi</span>
                    <h4 className="title"> Trải nghiệm thế giới với công ty của chúng tôi</h4>
                    <p className="pera">
                      Du lịch là một trải nghiệm biến đổi và phong phú
                      cho phép các cá nhân khám phá các điểm đến, văn hóa mới và
                      Phong cảnh
                    </p>
                    <p className="pera">
                      Đó là một hoạt động cơ bản của con người đã được thực hành cho
                      hàng thế kỷ và tiếp tục là một nguồn vui, học tập và
                      phát triển cá nhân
                    </p>
                  </div>
                </div>
                <div className="col-lg-4">
                  <a className="dis-btn" href="/about">
                    <div className="discover-circle">
                      <a href="/about" className="discover-btn text-30">KHÁM PHÁ NHIỀU HƠN<i className="ri-arrow-right-up-line" /></a>
                    </div>
                  </a>
                </div>
              </div>
              <div className="about-banner-two">
                <h4 className="watermark-text  p-4 my-2">Hơn 15 năm kinh nghiệm </h4>
                <div className="video-section">
                  {/* Video */}
                  <div className="hero-bg-video">

                    <video className="hero-slider-video video-cover radius-30" poster={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/about-curve-banner.png`} loop autoPlay muted>
                      <source src={`${import.meta.env.VITE_BASE_URL}/assets/images/videos/travel1.mp4`} type="video/mp4" />

                      Trình duyệt của bạn không hỗ trợ thẻ video.
                    </video>
                  </div>
                  <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/gallery/about-curve-banner.png`} alt="travello" />
                  <div className="rectangle-shape d-none d-sm-block">
                    <div className="sticky-corner right-corner">
                      <svg xmlns="http://www.w3.org/2000/svg" width={35} height={35} viewBox="0 0 35 35" fill="none">
                        <path fillRule="evenodd" clipRule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z" fill="#daedef" />
                      </svg>
                    </div>
                    <div className="sticky-corner bottom-corner">
                      <svg xmlns="http://www.w3.org/2000/svg" width={35} height={35} viewBox="0 0 35 35" fill="none">
                        <path fillRule="evenodd" clipRule="evenodd" d="M35 0V35C35 15.67 19.33 0 -1.53184e-05 0H35Z" fill="#daedef" />
                      </svg>
                    </div>
                  </div>
                  <a href="https://www.youtube.com/watch?v=Cn4G2lZ_g2I" className="d-none d-sm-block " data-fancybox="video-gallery">
                    <div className="video-player">
                      <i className="ri-play-fill" />
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </section>
          {/*/ End-of About US*/}
          {/* Packages S t a r t */}
          <section className="package-area section-padding2">
            <div className="container">
              <div className="row justify-content-center">
                <div className="col-xl-7 col-lg-7">
                  <div className="section-title mx-430 mx-auto text-center">
                    <span className="highlights text-30"> Gói phổ biến</span>
                    <h4 className="title">
                      Địa điểm du lịch yêu thích nhất ở Việt Nam

                    </h4>
                  </div>
                </div>
              </div>

              <div className="tab-content" id="pills-tabContent">
                <div className="tab-pane fade show active" id="pills-london" role="tabpanel" aria-labelledby="pills-london-tab">
                  <div className="row g-4">
                    {tourFeature?.map((tour: any, index: any) => {
                      return (
                        <div className="col-xl-3 col-lg-4 col-sm-6" key={index}>
                          <div className="package-card">
                            <div className="package-img imgEffect4">
                              <Link to={`/tour-details/${tour.slug}`}>
                                <img src={`${import.meta.env.VITE_BACKEND_URL}/` + (tour.images ? tour.images : '')} alt="travello" />
                              </Link>
                            </div>
                            <div className="package-content">
                              <h4 className="area-name line-clamp-1">
                                <Link to={`/tour-details/${tour.slug}`}>{tour.title}</Link>
                              </h4>
                              <div className="location">
                                <i className="ri-map-pin-line" />
                                {tour.location.province}
                              </div>
                              <div className="packages-person">
                                <div className="count">
                                  <i className="ri-time-line" />
                                  <p className="pera mt-3 ml-2">{tour.day} Ngày {(tour.day - 1) == 0 ? '' : tour.day - 1 + ' Đêm'}</p>
                                </div>

                              </div>
                              <div className="price-review">
                                <div className="d-flex gap-10">
                                  <p className="text-muted text-decoration-line-through  mr-3 "><CurrencyFormatter amount={tour.promotion} /> </p>
                                  <p className="text-danger fw-bold"> <CurrencyFormatter amount={tour.price} /> </p>


                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      )



                    })}
                    {/*  */}
                  </div>
                </div>
                <div className="tab-pane fade" id="pills-bangkok" role="tabpanel" aria-labelledby="pills-bangkok-tab">


                </div>



              </div>
              <div className="row">
                <div className="col-12 text-center ">
                  <div className="section-button d-inline-block ">
                    <a href="tour-list ">
                      <div className="btn-primary-icon-sm pt-3">
                        <p className="pera  ">Xem tất cả các tour du lịch</p>
                        {/* <i className="ri-arrow-right-up-line" /> */}
                      </div>

                    </a>
                  </div>
                </div>
              </div>

            </div>
          </section>
          {/*/ End of Packages */}
          {/* Promotion S t a r t */}
          <div className="container">
            <div className="row justify-content-center">
              <div className="col-xl-7 col-lg-7">
                <div className="section-title text-center mx-605 mx-auto position-relative mb-60">


                </div>
              </div>
            </div>
            <div className="row g-4">
            </div>
          </div>
          {/*/ End of Brand */}
          {/* News S t a r t */}
          <section className="news-area section-padding2">
            <div className="container">
              <div className="row justify-content-center">
                <div className="col-xl-7 col-lg-7">
                  <div className="section-title text-center mx-605 mx-auto position-relative mb-60">
                    <span className="highlights text-30">News &amp; Bài báo</span>
                    <h4 className="title">
                      Bài viết mới nhất
                    </h4>
                  </div>
                </div>
              </div>
              <div className="row g-4">
                {postsNew?.map((post: any, index: any) => {
                  return (
                    <div className="col-xl-3 col-lg-3 col-sm-6" key={index}>
                      <Link to={"news-details/" + post.slug}>
                        <article className="news-card-two wow fadeInUp" data-wow-delay="0.0s">
                          <figure className="news-banner-two imgEffect">
                            <img className="images" src={`${import.meta.env.VITE_BACKEND_URL}/` + post.thumbnail} alt="travello" />
                          </figure>
                          <div className="news-content">
                            <div className="heading line-clamp-1">
                              <Link to={`/news-details/${post.slug}`}>{post.title} </Link>
                            </div>
                            <h4 className="title line-clamp-2">


                              <Link to={`/news-details/${post.slug}`}><div dangerouslySetInnerHTML={{ __html: post.body }} /> </Link>

                            </h4>
                            <div className="news-info">
                              <div className="d-flex gap-10 align-items-center">
                                <div className="all-user">
                                  <div className="happy-user">
                                    <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-1.jpeg`} alt="travello" />
                                  </div>
                                  <div className="happy-user">
                                    <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-2.png`} alt="travello" />
                                  </div>
                                  <div className="happy-user">
                                    <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-3.png`} alt="travello" />
                                  </div>
                                  <div className="happy-user">
                                    <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-4.jpeg`} alt="travello" />
                                  </div>
                                </div>
                              </div>
                              <p className="time">10 phút đọc</p>
                            </div>
                          </div>
                        </article>
                      </Link>
                    </div>

                  )
                })}

              </div>
              <div className="col-12 text-center">
                <div className="section-button d-inline-block wow fadeInUp" data-wow-delay="0.3s">
                  <Link to="news">
                    <div className="btn-primary-icon-sm pt-3">
                      <p className="pera">Xem tất cả các tin tức</p>
                      {/* <i className="ri-arrow-right-up-line" /> */}
                    </div>
                  </Link>
                </div>
              </div>
            </div>
          </section>
          {/*/ End of News */}
        </main>
        {/* Footer S t a r t */}
        <Footer />
        <div className="progressParent" id="back-top">
          <svg className="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
          </svg>
        </div>
        <div className="search-overlay" />
      </div>

    </div>
  )
}

export default Indextwo
