import axios from 'axios';

export const playAllWeeks = () => axios.post('/api/simulate-all');
export const playNextWeek = () => axios.post('/api/simulate-next');
export const resetLeague = () => axios.post('/api/reset');