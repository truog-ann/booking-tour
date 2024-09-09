import { useQuery } from "@tanstack/react-query"
import axios from "axios"
import { Link } from "react-router-dom"

const PostNewID = () => {
    const api = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-posts-new`
 	
    const { data } = useQuery({
        queryKey: ["POSTID"],
        queryFn: async () => {
            const response = await axios.get(api)
            console.log(data);
            return response.data.data

        }
    })

    // Ensure data is an array
    const datanew = Array.isArray(data) ? data : []
    // Sort and slice the data to get the 4 newest items
    const postnewid = datanew.sort((a, b) => b.id - a.id).slice(0,3)
  return (
    <div style={{ display: 'flex', justifyContent: 'space-around', gap: '5px' }}>
          {postnewid.map((post)=>{
            return (
                <div className="col-xl-4 col-lg-4 col-sm-6">
                <article className="news-card-two wow fadeInUp" data-wow-delay="0.0s">
                  <figure className="news-banner-two imgEffect">
                    <a href="news-details.html">
                    <img src={`${import.meta.env.VITE_BACKEND_URL}`+'/'+ (post.images? post.images[0].image : '')} alt="travello" />

                        </a>
                  </figure>
                  <div className="news-content">
                    <div className="heading">
                      <span className="heading-pera">{post.title}</span>
                    </div>
                    <h4 className="title line-clamp-2">
                   
                      <Link to={`/news-details/${post.id}`}>{post.body}</Link>
                    </h4>
                    <div className="news-info">
                      <div className="d-flex gap-10 align-items-center">
                        <div className="all-user">
                          <div className="happy-user">
                            <img src="assets/images/hero/user-1.jpeg" alt="travello" />
                          </div>
                          <div className="happy-user">
                            <img src="assets/images/hero/user-2.png" alt="travello" />
                          </div>
                          <div className="happy-user">
                            <img src="assets/images/hero/user-3.png" alt="travello" />
                          </div>
                          <div className="happy-user">
                            <img src="assets/images/hero/user-4.jpeg" alt="travello" />
                          </div>
                        </div>
                      </div>
                      <p className="time">10 min read</p>
                    </div>
                  </div>
                </article>
              </div>
            )
       
        }  )}
      
    </div>
  )
}

export default PostNewID
