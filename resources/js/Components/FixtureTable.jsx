import { Card, CardContent } from "@/Components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/Components/ui/table";
import { Badge } from "@/Components/ui/badge";

export default function FixtureTable({ matches }) {
    const groupedMatches = matches.reduce((acc, match) => {
        acc[match.week] = acc[match.week] || [];
        acc[match.week].push(match);
        return acc;
    }, {});

    const sortedWeeks = Object.keys(groupedMatches).sort((a, b) => Number(a) - Number(b));

    return (
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            {
                sortedWeeks.map((week) => (
                    <Card className="w-full mx-auto shadow-xl">
                        <CardContent className="p-6">
                            <div key={week} className="mb-6">
                                <h3 className="text-xl font-bold mb-2">Week {week}</h3>
                                <Table>
                                    <TableHeader>
                                        <TableRow>
                                            <TableHead>Match</TableHead>
                                            <TableHead className="text-center">Score</TableHead>
                                            <TableHead className="text-center">Status</TableHead>
                                        </TableRow>
                                    </TableHeader>
                                    <TableBody>
                                        {groupedMatches[week].map((match) => (
                                            <TableRow key={match.id} className="hover:bg-muted/30 transition">
                                                <TableCell>
                                                    <span className="font-medium">
                                                        {match.home_team.name} <span className="text-muted-foreground">vs</span> {match.away_team.name}
                                                    </span>
                                                </TableCell>
                                                <TableCell className="text-center">
                                                    {match.is_simulated
                                                        ? `${match.home_score} - ${match.away_score}`
                                                        : '--'}
                                                </TableCell>
                                                <TableCell className="text-center">
                                                    <Badge variant={match.is_simulated ? 'default' : 'outline'}>
                                                        {match.is_simulated ? 'Played' : 'Pending'}
                                                    </Badge>
                                                </TableCell>
                                            </TableRow>
                                        ))}
                                    </TableBody>
                                </Table>
                            </div>
                        </CardContent>
                    </Card>
                ))
            }
        </div>
    );
}