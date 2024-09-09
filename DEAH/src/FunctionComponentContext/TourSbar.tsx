import axios from "axios";
import { useEffect, useState } from "react";


const TourSbar = () => {
  const [tourlist, setPostsNew] = useState<any>([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        let tours_lists = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-tours-feature`;
        const [tourlist] = await Promise.all([
          axios.get(tours_lists),
        ]);
        // console.log(response1.data.data);

        setPostsNew(tourlist.data.data);
        console.log(tourlist);

      } catch (error) {
        if (error) return <div>loi...</div>
      }
    };
    fetchData();

  }, []);
  return (
    <div>
      <div className=" col-lg-12">
        <div className="row g-4 position-sticky top-0">
          <div className="col-lg-12">
            <div className="search-filter-section">

              <div className="heading">
                <h4 className="title">Gói Du Lịch Nổi Bật</h4>
              </div>
              <ul className="recent-news-list">
                {tourlist.map((item: any, index: number) => {
                  return (
                    <li className="list  " key={index}>
                      <a href={`/tour-details/${item.slug}`} className="destination-banner-two h-calc wow fadeInUp" data-wow-delay="0.s">
                        <img className='img' src={`${import.meta.env.VITE_BACKEND_URL}/` + (item.images ? item.images : '')} alt="travello" />
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
  )
}

export default TourSbar


