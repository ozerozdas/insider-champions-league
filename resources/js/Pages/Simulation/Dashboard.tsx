import { Head } from '@inertiajs/react';

export default function Welcome({ fixture }: { fixture: Array<any> }) {
    // console.log(fixture);
    return (
        <>
            <Head title="Dashboard" />

            <div className='flex flex-col items-center justify-center h-screen bg-gray-100'>
                <div className="bg-white p-10 rounded-xl shadow-xl text-center space-y-6 w-full max-w-md">

                </div>
            </div >
        </>
    );
}
