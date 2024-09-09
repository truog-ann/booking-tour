import { useQuery } from '@tanstack/react-query';
import axios from 'axios';
import { Link, useParams } from 'react-router-dom';

const PostNewDetail = () => {
    const { id } = useParams();
    console.log(id);

    const { data, isLoading, error } = useQuery({
        queryKey: ['KEY_POST', id],
        queryFn: async () => {
            const response = await axios.get(`${import.meta.env.VITE_BACKEND_URL}/api/client/get-post-detail/${id}`);
            console.log(response.data.data);
            return response.data.data;
        }
    });

    if (isLoading) return <div>Loading.....</div>;
    if (error) return <div>Error: {error.message}</div>;

    // Ensure data is defined and is an array
    const posts = data ? (Array.isArray(data) ? data : [data]) : [];

    return (
        <div>
            {posts.map((post, index) => (
                <ul className="recent-news-list" key={index}>
                    <li className="list">
                        <h4 className="title line-clamp-2">
                      
                            <Link to={`/news-details/${post.id}`}>{post.title}</Link>
                        </h4>
                        <div className="d-flex justify-content-between flex-wrap gap-8">
                            <div className="d-flex align-items-center gap-8">
                                <i className="ri-time-line" />
                                <p className="date">Jan 23, 2025</p>
                            </div>
                            <p className="time">10 phút đọc </p>
                        </div>
                    </li>
                </ul>
            ))}
        </div>
    );
}

export default PostNewDetail;
