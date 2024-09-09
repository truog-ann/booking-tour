
import { useQuery } from '@tanstack/react-query'
import axios from 'axios';
import { Link } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';


const New = () => {

  let api = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-posts-list`
  const { data, error, isLoading } = useQuery({
    queryKey: ["POST"],
    queryFn: async () => {
      const { data } = await axios.get(api)
      console.log(data.data.posts);
      return data.data.posts
    }
  })
  // console.log(data.data);

  if (isLoading) return <div>Loading.....</div>
  if (error) return <div>loi{error.message}</div>
  const posts = Array.isArray(data) ? data : [];
  return (

    <div>
      <div>
        <Header status={true}/>
        <main>
          {/* Breadcrumbs S t a r t */}
          <section className="breadcrumbs-area breadcrumb-bg">
            <div className="container">
              <h1 className="title wow fadeInUp" data-wow-delay="0.0s">Tin tức</h1>
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
          {/* About Us area S t a r t */}
          <section className="news-area section-padding2">
            <div className="container">
              <div className="row g-4 mb-60">
                <div className="col-xl-7 col-lg-7">
                  <div className="tab-content" id="v-pills-tabContent-two">
                    <div className="tab-pane  fade show active" id="pills-news-one" role="tabpanel" aria-labelledby="pills-news-one">
                      <div className="about-banner imgEffect4">
                        <img src="/src/assets/category_tour/HaNoi.png" alt="travello" />
                      </div>
                    </div>
                   
                   
                  </div>
                </div>

                <div className="col-xl-5 col-lg-5">
                  {posts.map((post, index) => (
                    <div className="all-contents" id="v-pills-tab-two" role="tablist" aria-orientation="vertical" key={index}>
                      <div className="news-content active" id="pills-news-one-tab" data-bs-toggle="pill" data-bs-target="#pills-news-one" role="tab" aria-controls="pills-news-one" aria-selected="true">
                        <div className="heading">
                          <span className="heading-pera">{post.title}</span>
                        </div>
                        <h4 className="title">
                          <a href="javascript:void(0)"> </a>
                        </h4>
                        <div className="news-info">
                          <div className="d-flex gap-10 align-items-center">
                            <div className="author-img">
                              <img src="/src/assets/images/news/news-1.jpeg" alt="travello" />
                            </div>
                            <p className="name">Thiếu Tên Người</p>
                          </div>
                          <p className="time"> 10 phút Đọc </p>
                        </div>
                      </div>

                      <div className="news-content" id="pills-news-three-tab" data-bs-toggle="pill" data-bs-target="#pills-news-three" role="tab" aria-controls="pills-news-three" aria-selected="true">


                        <div className="news-info">
                          <div className="d-flex gap-10 align-items-center">
                            <div className="author-img">
                              <img src="/src/assets/images/news/news-3.jpeg" alt="travello" />
                            </div>
                            <p className="name">Thiếu tên Người </p>
                          </div>
                          <p className="time">10 phút đọc </p>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>


              </div>
              <div className="row g-4">


                {posts.map((post) => (

                  <div className="col-xl-4 col-lg-4 col-sm-6" key={post.id} >
                    <Link to={`/news-details/${post.slug}`}>s
                      <article className="news-card-two">
                        <figure className="news-banner-two imgEffect">
                          <a href="news-details">
                            <img src="/src/assets/category_tour/phú quốc.jpg" alt="travello" />
                          </a>
                        </figure>
                        <div className="news-content">
                          <div className="heading">
                            <span className="heading-pera">{post.title}</span>

                          </div>
                          <h4 className="title line-clamp-2">
                            {post.body}

                          </h4>
                          <div className="news-info">
                            <div className="d-flex gap-10 align-items-center">
                              <div className="all-user">
                                <div className="happy-user">
                                  <img src="/src/assets/images/hero/user-1.jpeg" alt="image" />
                                </div>
                                <div className="happy-user">
                                  <img src="/src/assets/images/hero/user-2.png" alt="image" />
                                </div>
                                <div className="happy-user">
                                  <img src="/src/assets/images/hero/user-3.png" alt="image" />
                                </div>
                                <div className="happy-user">
                                  <img src="/src/assets/images/hero/user-4.jpeg" alt="image" />
                                </div>
                              </div>
                            </div>
                            <p className="time">10 phút đọc </p>
                          </div>
                        </div>
                      </article>
                    </Link>
                  </div>

                ))}


                <div className="col-12 text-center">
                  <div className="section-button d-inline-block">
                    <a href="javascript:void(0)">
                      <div className="btn-primary-icon-sm">
                        <i className="ri-loader-2-line" />
                        <p className="pera mt-3 ml-2">Đang tải</p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </section>
          {/*/ End-of About US*/}
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

export default New
