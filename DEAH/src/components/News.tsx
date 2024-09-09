import axios from 'axios';
import { Link } from 'react-router-dom';
import Header from './Header';
import Footer from './Footer';
import '../App.css'

import { useEffect, useState } from 'react';

const New = () => {
  const [postFeature, setPostFeature] = useState<any>([]);
  // const [postsNew, setPostsNew] = useState<any>([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        let postsFeatureApi = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-posts-list`;
        const [postFeature] = await Promise.all([
          axios.get(postsFeatureApi),
          // axios.get(postsNewApi)
        ]);
        console.log(postFeature.data.data);
        setPostFeature(postFeature.data.data);
        // setPostsNew(.data.data);
      } catch (error) {
        if (error) return <div>loi...</div>
      }
    };
    fetchData();
    // fetchDataNew();
  }, []);
  return (

    <div>
      <div>
        <Header status={undefined} />
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
                        <img src={`${import.meta.env.VITE_BASE_URL}/assets/category_tour/NhaTrang.jpg`} alt="travello" />

                        <img src={`${import.meta.env.VITE_BASE_URL}/assets/category_tour/Nhatrang.jpg`} alt="travello" />

                      </div>
                    </div>
                    <div className="tab-pane fade" id="pills-news-two" role="tabpanel" aria-labelledby="pills-news-two">
                      <div className="about-banner imgEffect4">
                        <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/news/banner-1.png`} alt="travello" />
                      </div>
                    </div>
                    <div className="tab-pane fade" id="pills-news-three" role="tabpanel" aria-labelledby="pills-news-three">
                      <div className="about-banner imgEffect4">
                        <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/news/banner-2.png`} alt="travello" />
                      </div>
                    </div>
                  </div>
                </div>

                <div className="col-xl-5 col-lg-5">
                  {postFeature.posts_feature?.map((post: any, index: number) => (
                    <div className="all-contents" id="v-pills-tab-two" role="tablist" aria-orientation="vertical" key={index}>
                      <a href={"news-details/" + post.slug}>
                        <div className="news-content active" id="pills-news-one-tab" data-bs-toggle="pill" data-bs-target="#pills-news-one" role="tab" aria-controls="pills-news-one" aria-selected="true">
                          <div className="heading d-flex gap-3">
                            <img className='rounded' width={100} src={`${import.meta.env.VITE_BACKEND_URL}/` + post.thumbnail} alt="travello" />
                            <div>
                              <p className="heading-pera line-clamp-1">{post.title}</p>
                              {/* <p className="heading-pera line-clamp-4">{post.body}</p> */}
                              <div className='heading-pera line-clamp-4' dangerouslySetInnerHTML={{ __html: post.body }} />
                            </div>

                          </div>
                          <h4 className="title">
                            <a href="javascript:void(0)"> </a>
                          </h4>
                          <div className="news-info">
                            <div className="d-flex gap-10 align-items-center">
                              <div className="author-img">
                                <img src={`${import.meta.env.VITE_BACKEND_URL}/` + post.thumbnail} alt="travello" />
                              </div>

                            </div>

                          </div>
                        </div>
                      </a>

                    </div>
                  ))}
                </div>
              </div>
              <div className="row g-4">
                <div className="row justify-content-center">
                  <div className="col-xl-7 col-lg-7">
                    <div className="section-title text-center mx-605 mx-auto position-relative mb-60">
                      <span className="highlights">News &amp; Bài báo</span>
                      <h4 className="title">
                        Latest News &amp; Bài viết Từ The Blog Bài viết
                      </h4>
                    </div>
                  </div>
                </div>

                {postFeature.posts?.map((post: any, index: number) => (
                  <div className="col-xl-4 col-lg-4 col-sm-6" key={index} >
                    <a href={"news-details/" + post.slug}>

                      <article className="news-card-two">
                        <figure className="news-banner-two imgEffect ">
                          <img className='image' src={`${import.meta.env.VITE_BACKEND_URL}/` + post.thumbnail} alt="travello" />
                        </figure>
                        <div className="news-content">
                          <div className="heading line-clamp-1">

                            <Link className='text-success' to={`/news-details/${post.slug}`}>{post.title}</Link>
                          </div>
                          <h4 className="title line-clamp-2">


                            <Link to={`/news-details/${post.slug}`}><div className='' dangerouslySetInnerHTML={{ __html: post.body }} /></Link>

                          </h4>
                          <div className="news-info">
                            <div className="d-flex gap-10 align-items-center">
                              <div className="all-user">
                                <div className="happy-user">
                                  <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-1.jpeg`} alt="image" />
                                </div>
                                <div className="happy-user">
                                  <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-2.png`} alt="image" />
                                </div>
                                <div className="happy-user">
                                  <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-3.png`} alt="image" />
                                </div>
                                <div className="happy-user">
                                  <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/hero/user-4.jpeg`} alt="image" />
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </article>
                    </a>

                  </div>

                ))}


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