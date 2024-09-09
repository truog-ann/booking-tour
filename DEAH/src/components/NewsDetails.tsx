
import axios from 'axios';
import { useParams } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';
import { useEffect, useState } from 'react';
const NewsDetails = () => {

  const { slug } = useParams();
  // console.log(id);
  const [postFeature, setPostFeature] = useState<any>([]);
  const [post, setPostDetail] = useState<any>([]);
 

  useEffect(() => {
    const fetchData = async () => {
      try {
        let postsFeatureApi = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-posts-list`;
        let postApi = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-post-detail/${slug}`;
        const [postFeature, post] = await Promise.all([
          axios.get(postsFeatureApi),
          axios.get(postApi)
        ]);
        setPostFeature(postFeature.data.data.posts_feature);
        setPostDetail(post.data.data);
      } catch (error) {
        if (error) return <div>loi...</div>
      }
    };
    fetchData();
  
  }, []);


  return (
    <div>
      <div>
        <Header status={undefined} />
        <main>
          {/* Breadcrumbs S t a r t */}
          <section className="breadcrumbs-area breadcrumb-bg">
            <div className="container">
              <h1 className="title wow fadeInUp" data-wow-delay="0.0s"> Chi tiết tin tức</h1>
              <div className="breadcrumb-text">
                <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                  <ul className="breadcrumb listing">
                    <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                    <li className="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)" className="single active">Tin tức</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </section>
          {/*/ End-of Breadcrumbs*/}
          {/* Điểm đến area S t a r t */}
          <section className="destination-details-section section-padding2">
            <div className="container">
              <div className="row g-4">


                <div className="col-xl-8 col-lg-7" >
                  <div className="news-details-banner imgEffect">
                    <img className='image' src={`${import.meta.env.VITE_BACKEND_URL}/` + post.thumbnail} alt="travello" />
                  </div>
                  <div className="news-details-content">

                    <div className='text-black font-bold' dangerouslySetInnerHTML={{ __html: post.title }} />
                    <div className='text-black font-bold' dangerouslySetInnerHTML={{ __html: post.body }} />

                  </div>

                  <div className="news-details-quote">
                    <h4 className="title">Du lịch làm cho một khiêm tốn. Bạn thấy những gì một nơi nhỏ bé chiếm giữ trong
                      thế giới. </h4>
                    <p className="pera">Gustav Flaubert</p>
                  </div>

                  
                  
                </div>

                <div className="col-xl-4 col-lg-5">
                  <div className="row g-4 position-sticky top-0">
                    <div className="col-lg-12">
                      <div className="search-filter-section">

                        <div className="heading">
                          <h4 className="title">Tin tức gần đây</h4>
                        </div>
                        <ul className="recent-news-list">
                          {postFeature.map((item: any, index: number) => {

                            return (
                              <li className="list  " key={index}>
                                <a href={`/news-details/${item.slug}`} className="destination-banner-two h-calc wow fadeInUp" data-wow-delay="0.s">
                                  <img className='ImageNewDetail' src={`${import.meta.env.VITE_BACKEND_URL}/` + (item.thumbnail ? item.thumbnail : '')} alt="travello" />

                                  <div className="destination-content-two">

                                    <div className="destination-info-two">
                                      <div className="destination-name line-clamp-2">
                                        <p className="pera">{item.title}</p>
                                      </div>
                                      <div className="button-section">
                                        <div className="arrow"><i className="ri-arrow-right-line" /></div>
                                      </div>
                                    </div>
                                  </div>
                                </a>
                              </li>
                            )
                          })}


                        </ul>
                      </div>
                    </div>
                    <div className="col-lg-12">
                      <div className="destination-offer-three">
                        <div className="destination-content-offer">
                          <span className="highlights">20% off</span>
                          <h4 className="title">The Best Du lịch Adventure</h4>
                          <a href="/tour-list" className="btn-secondary-sm radius-30">Đặt trước Now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </section>
          {/*/ End-of Điểm đến */}
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

export default NewsDetails
