import { useQuery } from '@tanstack/react-query'
import axios from 'axios'


const TourNewid = () => {
    const api = `${import.meta.env.VITE_BACKEND_URL}/api/client/get-tours-new`
    const { data } = useQuery({
        queryKey: ["TOURID"],
        queryFn: async () => {
            const response = await axios.get(api)
            return response.data.data
        }
    })

    // Ensure data is an array
    const datanew = Array.isArray(data) ? data : []

    // Sort and slice the data to get the 4 newest items
    const newestTours = datanew.sort((a, b) => b.id - a.id).slice(0, 4)

    return (
        <div style={{ display: 'flex', justifyContent: 'space-around', gap: '10px' }}>
            {newestTours.map((tour) => (
                <div className="col-xl-3 col-lg-4 col-sm-6" key={tour.id}>
                    <a href="destination-details.html" className="destination-banner-two h-calc wow fadeInUp" data-wow-delay="0.s">
                     
                        <img src={`${import.meta.env.VITE_BACKEND_URL}/` + (tour.images? tour.images[0].image : '')} alt="travello" />

                        <div className="destination-content-two">
                            <div className="ratting-badge">
                                <span>{tour.day} Ngày</span>
                            </div>
                            <div className="destination-info-two">
                                <div className="destination-name">
                                    <p className="pera">{tour.title}</p>
                                </div>
                                <div className="button-section">
                                    <div className="arrow"><i className="ri-arrow-right-line" /></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            ))}
        </div>
    )
}

export default TourNewid
