import ApplicationLogo from '@/Components/ApplicationLogo';
import { Toaster } from '@/Components/ui/toaster';
import { PropsWithChildren } from 'react';

export default function Layout({ children }: PropsWithChildren) {
    return (
        <>
            <div className='flex flex-col items-center justify-center h-screen bg-gray-100'>
                <ApplicationLogo />

                <div className='mt-6 w-full'>
                    {children}
                </div>
            </div>

            <Toaster />
        </>
    );
}
